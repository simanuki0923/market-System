<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use App\Models\Product;
use App\Models\User;
use App\Http\Requests\UpdateProfileRequest;

class MypageController extends Controller
{
    public function mypage()
    {
        $user = auth()->user();

        $listedProducts = $user->products()->get(); 

        $purchasedProducts = $user->purchases()->with('product')->get()->map(function ($purchase) {
            return [
                'id' => $purchase->product->id,
                'name' => $purchase->product->name,
                'image_url' => $purchase->product->image_url,
                'link' => route('product', ['id' => $purchase->product->id]),
                'category' => $purchase->product->category->name ?? 'Uncategorized',
                'brand' => $purchase->product->brand,
                'condition' => $purchase->product->condition,
            ];
        });

        $iconUrl = $user->profile && $user->profile->icon_image_path 
            ? asset('storage/' . $user->profile->icon_image_path) 
            : asset('img/sample.jpg');

        $userName = $user->profile && $user->profile->name 
            ? $user->profile->name 
            : $user->name;

        return view('mypage', [
            'user' => $user,
            'listedProducts' => $listedProducts,
            'purchasedProducts' => $purchasedProducts,
            'icon_url' => $iconUrl,
            'user_name' => $userName,
        ]);
    }

    public function edit()
    {
        $user = auth()->user()->load('profile');
        return view('profile', compact('user'));
    }

    public function update(UpdateProfileRequest $request)
    {
        $user = auth()->user();
        $profile = $user->profile ?: $user->profile()->create();
        $profile->name = $request->input('name');
        $user->name = $request->input('name');
        $profile->postal_code = $request->input('postal_code');
        $profile->address = $request->input('address');
        $profile->building = $request->input('building');

        if ($request->hasFile('icon_image')) {
            if ($profile->icon_image_path) {
                \Storage::delete('public/' . $profile->icon_image_path);
            }

            $iconPath = $request->file('icon_image')->store('public/icons');
            $profile->icon_image_path = str_replace('public/', '', $iconPath);
        }

        $profile->save();
        $user->save();

        return redirect()->route('profile.edit')->with('success', 'プロフィールが更新されました。');
    }
}