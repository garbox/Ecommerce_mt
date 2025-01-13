<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Stripe\Stripe;
use Stripe\PaymentIntent;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    // Handle the one-time payment
    public function processPayment(Request $request){
        $stripeCharge = Auth::user()->charge(
            $request->total, 
            $request->paymentMethodId, 
            ['return_url' => route('orderstatus')]
        );
        
        if($stripeCharge->status != 'succeeded'){
            return false;
        }
        else {
            return true;
        }
    }
}
