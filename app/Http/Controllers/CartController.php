<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;

class CartController extends Controller
{
    public function addItem(Request $request)
    {
        if (isset($request->user_id) && isset($request->disc_id)) {
            $cart = New Cart;
            $cart->user_id = $request->user_id;
            $cart->disc_id = $request->disc_id;
            $cart->save();
    
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
