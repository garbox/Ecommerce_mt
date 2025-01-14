<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Models\User;
use Stripe\Stripe;
use Stripe\PaymentIntent;
use Illuminate\Support\Facades\Auth;

class Payment extends Model
{
    // Handle the one-time payment
    public static function processPayment(Request $request){
        $stripeCharge = Auth::user()->charge(
            $request->total, 
            $request->paymentMethodId, 
            ['return_url' => route('orderstatus')]
        );
        return $stripeCharge;
    }
}
