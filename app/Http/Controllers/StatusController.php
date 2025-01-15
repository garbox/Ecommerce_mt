<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    public function update(Request $request){
        $request->validate([
            'status' => 'integer',
        ]);

        $order = Order::find($request->orderid);
        $order->status_id = $request->status;

        if ($order->save()){
            return back()->with('success', 'Status updated!');
        }
        else{
            return back()->with('error', 'Not able to update status!');
        }

       
    }
}
