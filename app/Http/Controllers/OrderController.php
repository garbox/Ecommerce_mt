<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\OrderItem;
use App\Models\Order;
use App\Models\User;
use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\CartAttribute;
use App\Models\Status;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    //dashboard index
    public function index(){ 
        $userId = session()->get('id');
        $user = User::find($userId);
        $orders = Order::where('user_id', $userId)->get();
        return view('orderstatus', ['user'=>$user, 'orders' => $orders]);
    }

    public  static function create(Request $request){
        Order::create($request);
        return redirect()->route('orderstatus');
    }

    // This function accepts an order ID as a parameter, verifies the order ID against the associated user ID, 
    // and then gathers all the necessary information related to the order in a nested array.
    public function details(int $id){
        return view('/orderinfo', ['orderDetails' => Order::getDeatils2($id)]);
    }

}
