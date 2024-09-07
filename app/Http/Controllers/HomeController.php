<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Models\User;

use App\Models\Category;

use App\Models\Product;

use App\Models\Cart;

use App\Models\order;

use App\Models\Address;
use App\Models\Wish;
use Illuminate\Support\Facades\Session;

use Illuminate\Support\Facades\DB;

use Carbon\Carbon;


class HomeController extends Controller
{
    //
    public function funny()
    {
        if (Auth::id()) {
            $usertype = Auth::user()->usertype;
            if ($usertype == '1') {

                // dd($usertype);
                return $this->redirect();
            } else {
                // dd($usertype);

                return $this->index();
            }
        } else {
            return redirect('login');
        }
    }

    public function redirect()
    {
        if (Auth::id()) {

            $usertype = Auth::user()->usertype;
            if ($usertype == '1') {
                $total_product = Product::all()->count();

                $total_order = order::all()->count();

                $total_user = User::all()->count();

                $orders = order::all();

                $total_revenue = 0;

                foreach ($orders as $order) {
                    if ($order->delivery_status == 'delivered') {

                        $total_revenue += $order->price;
                    }
                }

                // getting current month

                $currentYear = Carbon::now()->year;
                $currentMonth = Carbon::now()->month;


                $month_total_order = Order::whereYear('created_at', $currentYear)
                    ->whereMonth('created_at', $currentMonth)
                    ->count();

                $new_user = User::whereYear('created_at', $currentYear)
                    ->whereMonth('created_at', $currentMonth)
                    ->count();

                $month_orders = Order::whereYear('created_at', $currentYear)
                    ->whereMonth('created_at', $currentMonth)
                    ->get();

                $month_total_revenue = 0;

                foreach ($month_orders as $order) {
                    if ($order->delivery_status == 'delivered') {
                        $month_total_revenue += $order->price;
                    }
                }

                $order_process = order::where('delivery_status', 'Processing')->count();

                $order_delivered = Order::where('delivery_status', 'delivered')
                    ->whereYear('created_at', $currentYear)
                    ->whereMonth('created_at', $currentMonth)
                    ->count();

                $order_cancelled = Order::where('delivery_status', 'cancelled')
                    ->whereYear('created_at', $currentYear)
                    ->whereMonth('created_at', $currentMonth)
                    ->count();


                $users = User::all();

                return view('admin.home', compact('total_product', 'total_order', 'total_user', 'total_revenue', 'order_delivered', 'order_process', 'order_cancelled', 'month_total_order', 'month_total_revenue', 'new_user', 'users'));
            } else {

                $user = Auth::user();

                $products = [];
                $cart_products = [];

                $categories = category::all();

                $carts = Cart::where('user_id', Auth::id())->get();

                foreach ($carts as  $cart) {
                    $cart_product = product::find($cart->product_id);

                    if ($cart_product) {
                        $cart_products[] = [
                            'id' => $cart->id,
                            'product' => $cart_product,
                            'quantity' => $cart->quantity
                        ];
                    }
                }

                $wishes = Wish::where('user_id', Auth::id())->count();



                return view('home.dashboard.myaccount', compact('categories', 'cart_products', 'wishes'));
            }
        } else {
            return redirect('login');
        }
    }



    public function myorder()
    {

        if (Auth::id()) {

            $user = Auth::user();

            $products = [];
            $cart_products = [];
            $order_products = [];
            $categories = category::all();

            $carts = Cart::where('user_id', Auth::id())->get();

            foreach ($carts as  $cart) {
                $cart_product = product::find($cart->product_id);



                if ($cart_product) {
                    $cart_products[] = [
                        'id' => $cart->id,
                        'product' => $cart_product,
                        'quantity' => $cart->quantity
                    ];
                }
            }


            $orders = order::where('user_id', $user->id)->get()->sortByDesc('created_at');


            foreach ($orders as  $order) {

                $product = product::find($order->product_id);
                if ($product) {

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
            }

            $wishes = Wish::where('user_id', Auth::id())->count();



            return view('home.dashboard', compact('categories', 'cart_products', 'order_products', 'wishes'));
        } else {
            return redirect('login');
        }
    }


    public function shippingAddressManage()
    {

        if (Auth::id()) {

            $user = Auth::user();

            $products = [];
            $cart_products = [];
            $categories = category::all();

            $carts = Cart::where('user_id', Auth::id())->get();

            foreach ($carts as  $cart) {
                $cart_product = product::find($cart->product_id);



                if ($cart_product) {
                    $cart_products[] = [
                        'id' => $cart->id,
                        'product' => $cart_product,
                        'quantity' => $cart->quantity
                    ];
                }
            }
            $wishes = Wish::where('user_id', Auth::id())->count();


            $Addresses = address::where('user_id', $user->id)->get();

            return view('home.dashboard.address', compact('categories', 'cart_products', 'Addresses', 'wishes'));
        } else {
            return redirect('login');
        }
    }


    public function addaddress(Request $request)
    {
        if (Auth::id()) {
            $user = Auth::id();

            $door_number = $request->input('door_number');
            $street = $request->input('street');
            $post_office = $request->input('post_office');
            $district = $request->input('district');
            $state = $request->input('state');
            $postal_code = $request->input('postal_code');

            // Create a new Address instance
            $address = new Address();

            // Set the attributes
            $address->user_id = $user;
            $address->door_number = $door_number; // Assuming $door_number is defined
            $address->street = $street; // Assuming $street is defined
            $address->post_office = $post_office; // Assuming $post_office is defined
            $address->district = $district; // Assuming $district is defined
            $address->state = $state; // Assuming $state is defined
            $address->pincode = $postal_code; // Assuming $postal_code is defined

            // Save the data to the database
            $address->save();

            $message = 'Shipping Address Added';


            return back()->with('success', $message);
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
            $firstProduct = $productsInCategory->first();
            $firstImage = '';

            if ($firstProduct && !empty($firstProduct['image'])) {
                $images = json_decode($firstProduct['image'], true); // Decode the JSON string
                if (is_array($images) && !empty($images)) {
                    $firstImage = $images[0]; // Get the first image from the array
                }
            }

            $cards[] = [
                'category' => $category,
                'image' => $firstImage,
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


        // top selling

        $topSellingProducts = [];



        // Iterate through each category
        foreach ($categories as $category) {
            // Retrieve the top-selling product for the current category

            $topSellingProduct = DB::table('orders')
                ->join('products', 'orders.product_id', '=', 'products.id')
                ->select('products.id', 'products.title', 'products.image', 'products.category', 'products.price', 'products.discount_price', DB::raw('SUM(orders.quantity) as total_quantity'))
                ->where('products.category', '=', $category->category_name)
                ->groupBy('products.id', 'products.title', 'products.image', 'products.category', 'products.price', 'products.discount_price') // Include selected columns in GROUP BY
                ->orderByDesc('total_quantity')
                ->take(4) // Limit to top 4 products
                ->get();

            // dd($topSellingProduct);

            // Add the top-selling product to the array
            // Add the top-selling product to the array if it has data
            if ($topSellingProduct->isNotEmpty()) {
                $topSellingProducts[$category->category_name] = $topSellingProduct;
            }
        }

        // dd($topSellingProducts);

        return view('home.userpage', compact('categories', 'products', 'cards', 'topSellingProducts'));
    }


    public function productdetails(Request $request)
    {
        $categories = category::all();

        $product = product::find($request->product);

        $cart_products = [];

        $wishes = 0;
        if (Auth::id()) {
            $carts = Cart::where('user_id', Auth::id())->get();

            foreach ($carts as  $cart) {
                $cart_product = product::find($cart->product_id);


                if ($cart_product) {
                    $cart_products[] = [
                        'id' => $cart->id,
                        'product' => $cart_product,
                        'quantity' => $cart->quantity
                    ];
                }
            }

            $wishes = Wish::where('user_id', Auth::id())->count();
        }

        return view('home.productdetails', compact('product', 'cart_products', 'categories', 'wishes'));
    }




    // cart
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

                if ($cart_product) {
                    $cart_products[] = [
                        'id' => $cart->id,
                        'product' => $cart_product,
                        'quantity' => $cart->quantity
                    ];
                }
            }

            $Addresses = address::where('user_id', Auth::id())->get();

            $wishes = Wish::where('user_id', Auth::id())->count();


            return view('home.view_cart', compact('cart_products', 'categories', 'Addresses', 'wishes'));
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

    // wish
    public function addtowish(Request $request)
    {
        if (Auth::id()) {
            $user = Auth::id();
            $product = $request->product;
            $quantity = $request->quantity;

            $cart = new Wish();

            $cart->user_id = $user;
            $cart->product_id = $product;
            $cart->quantity = $quantity;

            $cart->save();

            $message = 'Product Added to wishlist';


            return back()->with('success', $message);
        } else {
            return redirect('login');
        }
    }

    public function updatewish(Request $request)
    {
        if (Auth::id()) {

            $cart = Cart::find($request->id);

            $cart->quantity = $request->quantity;

            $cart->save();

            $message = 'WishList Updated';

            return back();
        } else {
            return redirect('login');
        }
    }

    public function viewwish()
    {
        if (Auth::id()) {

            $categories = category::all();

            $carts = Cart::where('user_id', Auth::id())->get();

            $cart_products = [];
            foreach ($carts as  $cart) {
                $cart_product = product::find($cart->product_id);

                if ($cart_product) {
                    $cart_products[] = [
                        'id' => $cart->id,
                        'product' => $cart_product,
                        'quantity' => $cart->quantity
                    ];
                }
            }

            $wishes = Wish::where('user_id', Auth::id())->get();
            $wish_products = [];
            foreach ($wishes as  $wish) {
                $wish_product = product::find($wish->product_id);

                if ($wish_product) {
                    $wish_products[] = [
                        'id' => $wish->id,
                        'product' => $wish_product,
                        'quantity' => $wish->quantity
                    ];
                }
            }

            $wishes = Wish::where('user_id', Auth::id())->count();


            return view('home.view_wish', compact('cart_products', 'categories', 'wish_products', 'wishes'));
        } else {
            return redirect('login');
        }
    }



    public function deletewish(Request $request)
    {
        if (Auth::id()) {
            $data = Wish::find($request->product);

            $data->delete();

            $message = 'Product Deleted Successfully';

            return back()->with('success', $message);
        } else {
            return redirect('login');
        }
    }

    public function clearwish()
    {
        if (Auth::id()) {
            $clearcarts = Wish::where('user_id', Auth::id())->get();

            foreach ($clearcarts as  $cart) {
                $cart->delete();
            }

            $message = 'Wish list Cleared!';

            return back()->with('success', $message);
        } else {
            return redirect('login');
        }
    }



    public function movetocart(Request $request)
    {
        $products = $request->input('product', []);

        foreach ($products as $productid) {

            $cart = new Cart();

            $wish = Wish::find($productid);

            $product = product::find($wish->product_id);

            if ($product !== null && $wish !== null) {

                $cart->user_id = $wish->user_id;
                $cart->product_id = $wish->product_id;
                $cart->quantity = $wish->quantity;
            }
            $wish->delete();

            $cart->save();
        }

        $message = 'Moved to Cart';

        return back()->with('success', $message);
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


    public function categorypage($category)
    {

        $categories = category::all();

        $categoryname = $category;

        if ($categoryname == 'all') {
            # code...
            $products = product::paginate(9);
        } else {
            # code...
            $products = product::where('category', $category)->paginate(9);
        }


        $cart_products = [];

        $wishes = 0;

        if (Auth::id()) {
            $carts = Cart::where('user_id', Auth::id())->get();

            foreach ($carts as  $cart) {
                $cart_product = product::find($cart->product_id);


                if ($cart_product) {
                    $cart_products[] = [
                        'id' => $cart->id,
                        'product' => $cart_product,
                        'quantity' => $cart->quantity
                    ];
                }
            }

            $wishes = Wish::where('user_id', Auth::id())->count();
        }


        $priceRange = '';
        return view('home.categorypage', compact('products', 'cart_products', 'categories', 'categoryname', 'priceRange', 'wishes'));
    }

    public function search(Request $request)
    {
        $categories = Category::all();

        $categoryname = $request->input('category');
        $searchtext = $request->input('search_query');
        $priceRange = $request->input('price_range');

        // dd($categoryname);

        $productsQuery = Product::query();
        if ($categoryname) {

            if (is_array($categoryname)) {
                $productsQuery->whereIn('category', $categoryname);
            } else if ($categoryname != 'all') {
                $productsQuery->where('category', $categoryname);
            }
        }


        // Filter by search text
        $productsQuery->where(function ($query) use ($searchtext) {
            $query->where('title', 'LIKE', '%' . $searchtext . '%')
                ->orWhere('description', 'LIKE', '%' . $searchtext . '%')
                ->orWhere('category', 'LIKE', '%' . $searchtext . '%');
        });

        // // Filter by price range if selected
        if ($priceRange) {
            foreach ($priceRange as $index => $Range) {
                // Extracting price range values
                list($minPrice, $maxPrice) = explode('-', $Range);

                if ($minPrice == 'above') {
                    # code...

                    // If it's not the first condition, add 'OR'
                    if ($index == 0) {
                        $productsQuery->where('price', '>', $maxPrice);
                    } else {
                        // Use ORWhereBetween instead of WhereBetween for subsequent conditions
                        $productsQuery->orwhere('price', '>', $maxPrice);
                    }
                } else {
                    # code... 
                    if ($minPrice == 'below') {
                        $minPrice = 0;
                    }

                    // Convert min and max prices to decimal
                    $minPrice = floatval($minPrice);
                    $maxPrice = floatval($maxPrice);

                    // If it's not the first condition, add 'OR'
                    if ($index == 0) {
                        $productsQuery->whereBetween('price', [$minPrice, $maxPrice]);
                    } else {
                        // Use ORWhereBetween instead of WhereBetween for subsequent conditions
                        $productsQuery->orWhereBetween('price', [$minPrice, $maxPrice]);
                    }
                }
            }
        }

        $sql = $productsQuery->toSql();
        // dd($sql);

        // Paginate the results

        $products = $productsQuery->paginate(9);

        // $products = $productsQuery->get();
        // dd($products);


        // Load cart products
        $wishes = 0;

        $cart_products = [];
        if (Auth::id()) {
            $carts = Cart::where('user_id', Auth::id())->get();

            foreach ($carts as $cart) {
                $cart_product = Product::find($cart->product_id);


                if ($cart_product) {
                    $cart_products[] = [
                        'id' => $cart->id,
                        'product' => $cart_product,
                        'quantity' => $cart->quantity
                    ];
                }
            }

            $wishes = Wish::where('user_id', Auth::id())->count();
        }


        return view('home.categorypage', compact('products', 'cart_products', 'categories', 'categoryname', 'priceRange', 'wishes'));
    }




    public function cancel(Request $request)
    {
        $orderid = $request->product;
        $order = order::find($orderid);

        $order->delivery_status = 'cancelled';

        $order->save();

        return redirect()->back()->with('del-message', 'Order Cancelled !');
    }
}
