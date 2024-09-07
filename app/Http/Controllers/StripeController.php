<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Stripe\Stripe;

use App\Models\Product;

use App\Models\Cart;

use App\Models\order;

class StripeController extends Controller
{
    //

    public function pay_card(Request $request)
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
                $order->payment_status = "completed";
                $order->delivery_status = "Processing";



                $product->quantity -= $cart->quantity;
            }
            $cart->delete();
            $product->save();
            $order->save();
        }


        \Stripe\Stripe::setApiKey(config('stripe.sk'));

        $total = $request->get('totalprice');

        $total = $total * 100;



        $session = \Stripe\Checkout\Session::create([
            'line_items' => [
                [
                    'price_data' => [
                        'currency' => 'INR',
                        'product_data' => [
                            'name' => 'product',
                        ],
                        'unit_amount' => $total,
                    ],
                    'quantity' => 1,
                ],
            ],

            'mode' => 'payment',
            'success_url' => url('/myorder'),
            'cancel_url' => url('/viewcart'),
        ]);

        return redirect()->away($session->url);
    }

    public function success()
    {
        return "payment Successful";
    }
}
