<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Payment;
use App\Http\Requests\UpdatePaymentMethodRequest;
use App\Http\Requests\UpdateAddressRequest;
use Illuminate\Http\Request;

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

        if ($product->is_sold) {
            return redirect()->back()->with('error', 'この商品は既にソールドアウトです');
        }

        $profile = Auth::user()->profile;
        $payment = Auth::user()->payment;

        return view('purchase', compact('product', 'profile', 'payment'));
    }

    public function editAddress()
    {
        $user = Auth::user();
        
        if (!$user->profile) {
            $user->profile()->create([]);
        }

        $profile = $user->profile;
        return view('address', compact('profile'));
    }

    public function updateAddress(UpdateAddressRequest $request)
    {
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
        $payment = $user->payment;

        if (!$payment) {
            $payment = new Payment();
        }

        return view('payment', compact('payment'));
    }

    public function updatePaymentMethod(UpdatePaymentMethodRequest $request)
    {
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