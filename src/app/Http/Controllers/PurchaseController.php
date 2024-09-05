<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Product;

class PurchaseController extends Controller
{
    public function purchase(Request $request)
    {
        $productId = $request->input('product_id');
        $product = Product::find($productId);

        if (!$product) {
            return redirect()->back()->with('error', '商品が見つかりません');
        }

        $profile = Auth::user()->profile;

        return view('purchase', compact('product', 'profile'));
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
}