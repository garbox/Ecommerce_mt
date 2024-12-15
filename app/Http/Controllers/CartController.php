<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\CartAttribute;
use App\Models\ProductAttribute;
use App\Models\Product;

class CartController extends Controller
{
    //dashboard index
    public function index(Request $request){
        $cartItems = Cart::get($request);
        $total = Cart::getTotal($cartItems);
        return view('cart', ['cart' => $cartItems, 'total' => $total]);
    }

    public function addToCart(Request $request){
        Cart::add($request);
        return redirect()->route('cart');
    }

    public function removeFromCart(Request $request){
        Cart::remove($request);
        return redirect()->route('cart');
    }
}
