<?php

namespace App\View\Components;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;
use Illuminate\View\View;

use App\Models\Category;
use App\Models\Product;
use App\Models\Wish;
use App\Models\Cart;


class UserLayout extends Component
{
    /**
     * Get the view / contents that represents the component.
     */
    public function render(): View
    {
        $user = Auth::user();
        $categories = category::all();
        $wishes = 0;
        $cart_products = [];

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


        return view('layouts.user', ['user' => $user, 'categories' => $categories, 'wishes' => $wishes, 'cart_products' => $cart_products]);
    }
}
