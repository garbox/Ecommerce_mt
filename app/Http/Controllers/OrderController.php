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
use App\Models\State;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    //dashboard index
    public function index(){ 
        $userId = session()->get('id');
        $orders = DB::table('orders')
        ->select("orders.id", "orders.total_price", "orders.status_id", "orders.user_id", "orders.created_at", "statuses.status")
        ->leftJoin('statuses', 'orders.status_id', '=', 'statuses.id')
        ->where('user_id', '=' , Auth::user()->id)->get(); 
        return view('orderstatus', ['user'=>Auth::user(), 'orders' => $orders]);
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

    public function charge (){
        return view('cctest',["user" => Auth::user(), "states" => State::all()]);
    }

}
