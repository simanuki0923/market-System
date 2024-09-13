<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Payment;

class PurchaseController extends Controller
{
    public function purchase(Request $request)
    {
        $productId = $request->input('product_id');
        $product = Product::find($productId);

        $user = Auth::user();

        if ($product->user_id === $user->id) {
            return redirect()->back()->with('error', '自分が出品した商品は購入できません');
        }

        $profile = Auth::user()->profile;
        $payment = Auth::user()->payment; // Fetch the payment details

        return view('purchase', compact('product', 'profile', 'payment'));
    }

    public function editAddress()
    {
        $user = Auth::user();
        
        if (!$user->profile) {
            // プロファイルが存在しない場合、新しいプロファイルを作成する
            $user->profile()->create([]);
        }

        $profile = $user->profile;
        return view('address', compact('profile'));
    }

    public function updateAddress(Request $request)
    {
        $request->validate([
            'postal_code' => 'required|string|max:7',
            'address' => 'required|string|max:255',
            'building' => 'nullable|string|max:255',
        ]);

        $profile = Auth::user()->profile;

        $profile->update([
            'postal_code' => $request->postal_code,
            'address' => $request->address,
            'building' => $request->building,
        ]);

        return redirect()->route('purchase')->with('status', '住所が更新されました');
    }

    public function editPaymentMethod()
    {
        $user = Auth::user();
        $payment = $user->payment; // Assuming a user has one payment method

        if (!$payment) {
            // Create a new payment method record if it doesn't exist
            $payment = new Payment();
        }

        return view('payment', compact('payment'));
    }

    public function updatePaymentMethod(Request $request)
    {
        $request->validate([
            'payment_method' => 'required|in:credit_card,convenience_store,bank_transfer',
        ]);

        $user = Auth::user();
        $payment = $user->payment;

        if (!$payment) {
            $payment = new Payment();
            $payment->user_id = $user->id;
        }

        $payment->payment_method = $request->payment_method;
        $payment->save();

        return redirect()->route('purchase')->with('status', '支払い方法が更新されました');
    }
}