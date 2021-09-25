<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Cart;

class CartController extends Controller
{
    public function listItem($user_id)
    {

        $user = User::where('id', '=', $user_id)->first();
        $carts = $user->carts;

        $items = [];
        foreach($carts as $cart) {
            $items[] = $cart->disc;
        }

        return $items;

    }

    public function addItem(Request $request)
    {
        if (isset($request->user_id) && isset($request->disc_id)) {

            $cart = Cart::firstOrCreate([
                'user_id' => $request->user_id,
                'disc_id' => $request->disc_id
            ]);
    
            return true;

        } else {

            return false;

        }

    }

    public function removeItem(Request $request)
    {
        if (isset($request->cart_id)) {
            $cart = Cart::where('id', '=', $request->cart_id)->first();
            $cart->delete();
            return true;
        } else {
            return false;
        }

    }
}
