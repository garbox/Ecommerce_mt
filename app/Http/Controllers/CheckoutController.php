<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\State;
use App\Models\User;
use App\Models\Order;

class CheckoutController extends Controller
{
    //dashboard index
    public function index(Request $request){
        $user = User::find(Auth::user()->id);
        $states = State::all();
        $total = Cart::getTotal(Cart::get($request));
        return view('checkout', ['cart' => Cart::get($request), 'states' => $states, 'user' => $user, 'total_price' => $total]);
    }

    public static function create(Request $request){
        //create order first
        //add order items with forginID to order
        $orderID = Order::insertGetId([
            'user_Id' => $request->session()->get('id'),
            'total_price' => '',
            '' => '',
            '' => '',
        ]);

    }
}
