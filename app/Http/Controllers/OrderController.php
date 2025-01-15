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
use App\Models\Payment;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Mail\InvoiceEmail;
use Illuminate\Support\Facades\Mail;

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

    //Creates order
    public  static function create(Request $request){
        $validated = $request->validate([
            'name' => 'required|string',
            'email' => 'required',
            'address' => 'required|string',
            'city' => 'required|string',
            'zip' => 'required|integer',
            'state' => 'required|integer',
            'ship_name' => 'required|string',
            'ship_address' => 'required|string',
            'ship_city' => 'required|string',
            'ship_zip' => 'required|integer',
            'ship_state' => 'required|integer',
        ]);
        
        $payIntentId = Payment::processPayment($request);
        if($payIntentId->status === "succeeded" ){
            $order = Order::create($request, $payIntentId);
            $orderDetails = Order::getDeatils2($order);
            Mail::to(Auth::user()->email)->send(new InvoiceEmail($orderDetails));
            return redirect()->route('orderstatus');
        }
        else {
            return redirect()->route('checkout');
        }
        
    }

    // This function accepts an order ID as a parameter, verifies the order ID against the associated user ID, 
    // and then gathers all the necessary information related to the order in a nested array.
    public function details(int $id){
        return view('/orderinfo', ['orderDetails' => Order::getDeatils2($id)]);
    }
}
