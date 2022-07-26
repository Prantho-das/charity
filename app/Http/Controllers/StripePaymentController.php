<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\User;

class StripePaymentController extends Controller
{
    public function donate()
    {
        return view('backend.stripe.card');
    }

    public function stripePost(Request $request)
    {

        Payment::create([
            'paid_by' => auth()->id(),
            'paid_amount' => $request->amount,
            'paid_for' => $request->paid_for,
            'transaction_id' => $request->transaction_id,
        ]);
        User::find(auth()->id())->increment('donation', $request->amount);
        return response()->json(['success' => 'Payment Successful']);
    }
}
