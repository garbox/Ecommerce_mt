<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Cookie;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function index(Request $request) {
        $prod = Product::all();
        return view('store' , ['prod' => $prod]);
    }
}
