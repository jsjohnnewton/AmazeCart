<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Category;
use App\Models\order;
use App\Models\Product;
use App\Models\User;

class AdminController extends Controller
{
    public function viewcategory()
    {
        $data = category::all();

        return view('admin.viewcategory', compact('data'));
    }

    public function add_category(Request $request)
    {
        $data = new category;


        $data->category_name = $request->category;

        $data->save();

        return redirect()->back()->with('message', 'Category added Successfully');
    }

    public function delete_category(Request $request)
    {
        $data = category::find($request->category);

        $data->delete();

        return redirect()->back()->with('del-message', 'Category Deleted Successfully');
    }


    public function addproduct()
    {
        $data = category::all();
        return view('admin.addproduct', compact('data'));
    }



    public function addproductdata(Request $request)
    {
        $data = new product;

        $data->title = $request->title;

        $data->description = $request->description;

        $data->category = $request->category;

        $data->quantity = $request->quantity;

        $data->price = $request->price;

        $data->discount_price = $request->discount;



        $image = $request->image;

        $imagename = time() . '.' . $image->getClientOriginalExtension();

        $request->image->move('product', $imagename);


        $data->image = $imagename;

        $data->save();

        return redirect()->back()->with('message', 'Product added Successfully');
    }


    public function viewproduct()
    {
        $data = product::all();
        return view('admin.viewproduct', compact('data'));
    }

    public function searchproduct(Request $request)
    {
        $searchtext = $request->search;
        $data = [];
        // Check if search text is not empty
        if (!empty($searchtext)) {
            $data = product::where('title', 'LIKE', '%' . $searchtext . '%')
                ->orWhere('description', 'LIKE', '%' . $searchtext . '%')
                ->orWhere('category', 'LIKE', '%' . $searchtext . '%')
                ->orWhere('price', '<=',  $searchtext)
                ->get();
            return view('admin.viewproduct', compact('data'));
        } else {
            $data = product::all();
            return view('admin.viewproduct', compact('data'));
        }
    }


    public function delete_product(Request $request)
    {
        $data = product::find($request->product);

        $data->delete();

        return redirect()->back()->with('del-message', 'Product Deleted Successfully');
    }

    public function update_product(Request $request)
    {
        $data = product::find($request->product);

        $category = category::all();

        $message = "";

        return view('admin.update_product', compact('data', 'category', 'message'));
    }

    public function updateproduct(Request $request)
    {
        $data = product::find($request->product);

        $data->title = $request->title;

        $data->description = $request->description;

        $data->category = $request->category;

        $data->quantity = $request->quantity;

        $data->price = $request->price;

        $data->discount_price = $request->discount;



        $image = $request->image;

        if ($image) {

            $imagename = time() . '.' . $image->getClientOriginalExtension();

            $request->image->move('product', $imagename);


            $data->image = $imagename;
        }


        $data->save();

        $data = product::find($request->product);

        $category = category::all();

        $message = "Product Updated Successfully";

        return view('admin.update_product', compact('data', 'category', 'message'));
    }


    public function vieworder()
    {
        $orders = order::all();

        $order_products = [];

        foreach ($orders as  $order) {

            $product = product::find($order->product_id);

            $user = User::find($order->user_id);


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


        return view('admin.vieworder', compact('order_products'));
    }


    public function searchorder(Request $request)
    {

        $searchtext = $request->search;

        $orders = order::all();

        $order_products = [];

        foreach ($orders as  $order) {

            $productid = $order->product_id;

            $product = product::where('id', '=', $productid)
                ->where('title', 'LIKE', '%' . $searchtext . '%')
                ->orWhere('description', 'LIKE', '%' . $searchtext . '%')
                ->orWhere('category', 'LIKE', '%' . $searchtext . '%')
                ->first();

            $user = User::find($order->user_id);


            if ($product && $user) {
                $order_products[] = [
                    'id' => $order->id,
                    'user' => $user->name,
                    'mail' => $user->email,
                    'phone' => $order->phone,
                    'address' => $order->delivery_address,
                    'product' => $product,
                    'quantity' => $order->quantity,
                    'payment' => $order->payment_status,
                    'delivery' => $order->delivery_status
                ];
            }
        }


        return view('admin.vieworder', compact('order_products'));
    }

    public function deleteorder(Request $request)
    {
        $data = order::find($request->product);

        $data->delete();

        return redirect()->back()->with('del-message', 'Order Removed Successfully');
    }
    public function delivered(Request $request)
    {
        $data = order::find($request->product);

        $data->delivery_status = "delivered";

        $data->payment_status = "completed";

        $data->save();

        return redirect()->back()->with('del-message', 'Status changed Successfully');
    }

    public function payment(Request $request)
    {
        $data = order::find($request->product);

        $data->payment_status = "completed";

        $data->save();

        return redirect()->back()->with('del-message', 'Status changed Successfully');
    }
}
