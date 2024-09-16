<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Purchase;
use Stripe\Stripe;
use Stripe\Charge;
use Exception;

class PaymentController extends Controller
{
    public function __construct()
    {
        Stripe::setApiKey(config('services.stripe.secret'));
    }

    public function create(Request $request)
    {
        $product = Product::findOrFail($request->productId);
        return view('payment.create', compact('product'));
    }

    public function store(Request $request)
    {
        $product = Product::findOrFail($request->product_id);
        
        if ($product->is_sold) {
            return redirect()->route('payment.create', ['productId' => $product->id])
                ->with('flash_alert', 'This product has already been sold.');
        }

        $token = $request->input('stripeToken');
        $amount = $product->price * 100; // Amount in cents

        try {
            $charge = Charge::create([
                'amount' => $amount,
                'currency' => 'jpy',
                'description' => 'Product Purchase',
                'source' => $token,
            ]);

            // Save purchase record
            Purchase::create([
                'user_id' => auth()->id(),
                'product_id' => $product->id,
                'price' => $product->price,
                'status' => 'paid',
                'purchase_date' => now(),
            ]);

            $product->is_sold = true;
            $product->save();

            return redirect()->route('payment.done')->with('status', 'Payment successful!');

        } catch (Exception $e) {
            return redirect()->route('payment.create', ['productId' => $product->id])->with('flash_alert', $e->getMessage());
        }
    }

    public function done()
    {
        return view('payment.done');
    }
}