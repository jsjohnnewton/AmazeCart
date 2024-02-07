<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Models\User;

use App\Models\Category;

use App\Models\Product;

use App\Models\Cart;

use App\Models\order;

use Illuminate\Support\Facades\Session;

use Stripe;


class HomeController extends Controller
{
    //
    public function redirect()
    {
        $usertype = Auth::user()->usertype;
        if ($usertype == '1') {
            $total_product = Product::all()->count();

            $total_order = order::all()->count();

            $total_user = User::all()->count();

            $orders = order::all();

            $total_revenue = 0;

            foreach ($orders as $order) {
                $total_revenue += $order->price;
            }


            $order_delivered = order::where('delivery_status', 'delivered')->count();
            $order_process = order::where('delivery_status', 'Processing')->count();


            return view('admin.home', compact('total_product', 'total_order', 'total_user', 'total_revenue', 'order_delivered', 'order_process'));
        } else {

            if (Auth::id()) {

                $user = Auth::user();

                $products = [];
                $categories = category::all();

                $carts = Cart::where('user_id', Auth::id())->get();

                foreach ($carts as  $cart) {
                    $cart_product = product::find($cart->product_id);


                    $cart_products[] = [
                        'id' => $cart->id,
                        'product' => $cart_product,
                        'quantity' => $cart->quantity
                    ];
                }

                $orders = order::where('user_id', $user->id)->get();

                $order_products = [];

                foreach ($orders as  $order) {

                    $product = product::find($order->product_id);

                    $order_products[] = [
                        'id' => $order->id,
                        'user' => $user->name,
                        'mail' => $user->email,
                        'phone' => $order->phone,
                        'address' => $order->delivery_address,
                        'product' => $product,
                        'quantity' => $order->quantity,
                        'price' => $order->price,
                        'payment' => $order->payment_status,
                        'delivery' => $order->delivery_status
                    ];
                }




                return view('home.dashboard', compact('categories', 'cart_products', 'order_products'));
            } else {
                return redirect('login');
            }
        }
    }


    public function myaccount()
    {

        if (Auth::id()) {

            $user = Auth::user();

            $products = [];
            $categories = category::all();

            $carts = Cart::where('user_id', Auth::id())->get();

            foreach ($carts as  $cart) {
                $cart_product = product::find($cart->product_id);


                $cart_products[] = [
                    'id' => $cart->id,
                    'product' => $cart_product,
                    'quantity' => $cart->quantity
                ];
            }

            return view('home.dashboard.account', compact('categories', 'cart_products'));
        } else {
            return redirect('login');
        }
    }
    public function index()
    {
        $categories = category::all();


        $group = product::orderBy('category')->get()->groupBy('category');

        $cards = [];
        foreach ($group as $category => $productsInCategory) {
            $cards[] = [
                'category' => $category,
                'image' => $productsInCategory->first()['image'],
            ];
        }

        $products = [];


        foreach ($categories as $key => $category) {
            $latestProducts = product::where('category', $category->category_name)
                ->orderBy('created_at', 'desc')
                ->take(4)
                ->get();

            foreach ($latestProducts as $product) {
                $products[$key][] = [
                    'product' => $product,
                ];
            }
        }

        $cart_products = [];

        if (Auth::id()) {
            $carts = Cart::where('user_id', Auth::id())->get();

            foreach ($carts as  $cart) {
                $cart_product = product::find($cart->product_id);


                $cart_products[] = [
                    'id' => $cart->id,
                    'product' => $cart_product,
                    'quantity' => $cart->quantity
                ];
            }
        }
        return view('home.userpage', compact('categories', 'products', 'cards', 'cart_products'));
    }


    public function productdetails(Request $request)
    {
        $categories = category::all();

        $product = product::find($request->product);

        $cart_products = [];

        if (Auth::id()) {
            $carts = Cart::where('user_id', Auth::id())->get();

            foreach ($carts as  $cart) {
                $cart_product = product::find($cart->product_id);


                $cart_products[] = [
                    'id' => $cart->id,
                    'product' => $cart_product,
                    'quantity' => $cart->quantity
                ];
            }
        }

        return view('home.productdetails', compact('product', 'cart_products', 'categories'));
    }

    public function addtocart(Request $request)
    {
        if (Auth::id()) {
            $user = Auth::id();
            $product = $request->product;
            $quantity = $request->quantity;

            $cart = new Cart();

            $cart->user_id = $user;
            $cart->product_id = $product;
            $cart->quantity = $quantity;

            $cart->save();

            $message = 'Product Added to Cart';


            return back()->with('success', $message);
        } else {
            return redirect('login');
        }
    }

    public function updatecart(Request $request)
    {
        if (Auth::id()) {

            $cart = Cart::find($request->id);

            $cart->quantity = $request->quantity;

            $cart->save();

            $message = 'Cart Updated';

            return back();
        } else {
            return redirect('login');
        }
    }

    public function viewcart()
    {
        if (Auth::id()) {

            $categories = category::all();

            $carts = Cart::where('user_id', Auth::id())->get();
            $cart_products = [];
            foreach ($carts as  $cart) {
                $cart_product = product::find($cart->product_id);


                $cart_products[] = [
                    'id' => $cart->id,
                    'product' => $cart_product,
                    'quantity' => $cart->quantity
                ];
            }


            return view('home.view_cart', compact('cart_products', 'categories'));
        } else {
            return redirect('login');
        }
    }



    public function deletecart(Request $request)
    {
        if (Auth::id()) {
            $data = Cart::find($request->product);

            $data->delete();

            $message = 'Product Deleted Successfully';

            return back()->with('success', $message);
        } else {
            return redirect('login');
        }
    }

    public function clearcart()
    {
        if (Auth::id()) {
            $clearcarts = Cart::where('user_id', Auth::id())->get();

            foreach ($clearcarts as  $cart) {
                $cart->delete();
            }

            $message = 'Cart Cleared!';

            return back()->with('success', $message);
        } else {
            return redirect('login');
        }
    }

    public function pay_cash(Request $request)
    {
        $products = $request->input('product', []);
        $address = $request->address;
        $phone = $request->phone;

        foreach ($products as $productid) {

            $order = new Order();

            $cart = Cart::find($productid);

            $product = product::find($cart->product_id);

            if ($product !== null && $cart !== null) {

                $order->user_id = $cart->user_id;
                $order->product_id = $cart->product_id;
                $order->quantity = $cart->quantity;
                $order->phone = $phone;
                $order->delivery_address = $address;

                $order->price = 0;
                if ($product->discount_price == null) {
                    $order->price = $product->price;
                } else {
                    $order->price = $product->discount_price;
                }
                $order->payment_status = "cash on delivery";
                $order->delivery_status = "Processing";



                $product->quantity -= $cart->quantity;
            }
            $cart->delete();
            $product->save();
            $order->save();
        }

        $message = 'Order Placed';

        return back()->with('success', $message);
    }
    public function pay_card(Request $request)
    {
        $totalprice = $request->totalprice;
        return view("home.pay_card", compact('totalprice'));
    }


    public function stripePost(Request $request)
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        Stripe\Charge::create([
            "amount" => 100 * 100,
            "currency" => "usd",
            "source" => $request->stripeToken,
            "description" => "Test payment from itsolutionstuff.com."
        ]);

        Session::flash('success', 'Payment successful!');

        return back();
    }


    public function categorypage($category)
    {

        $categories = category::all();

        $categoryname = $category;

        $products = product::where('category', $category);

        $cart_products = [];

        if (Auth::id()) {
            $carts = Cart::where('user_id', Auth::id())->get();

            foreach ($carts as  $cart) {
                $cart_product = product::find($cart->product_id);


                $cart_products[] = [
                    'id' => $cart->id,
                    'product' => $cart_product,
                    'quantity' => $cart->quantity
                ];
            }
        }

        return view('home.categorypage', compact('products', 'cart_products', 'categories', 'categoryname'));
    }
}
