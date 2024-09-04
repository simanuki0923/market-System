<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Purchase;
use App\Models\Product;
use App\Models\User;

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

    public function update(Request $request)
    {
        $user = auth()->user();

        // Retrieve the user's profile, or create a new one if it doesn't exist
        $profile = $user->profile ?: $user->profile()->create();

        // Validate the incoming request data
        $request->validate([
            'name' => 'required|string|max:255',
            'icon_image' => 'nullable|image|max:2048',
            'postal_code' => 'nullable|string|max:10',
            'address' => 'nullable|string|max:255',
            'building' => 'nullable|string|max:255',
        ]);

        // Update the name in the profiles table
        $profile->name = $request->input('name');
        // Update the name in the users table
        $user->name = $request->input('name');

        // Update other profile fields
        $profile->postal_code = $request->input('postal_code');
        $profile->address = $request->input('address');
        $profile->building = $request->input('building');

        // Handle the icon image upload
        if ($request->hasFile('icon_image')) {
            // Delete the old icon if it exists
            if ($profile->icon_image_path) {
                \Storage::delete('public/' . $profile->icon_image_path);
            }

            // Store the new icon image
            $iconPath = $request->file('icon_image')->store('public/icons');
            $profile->icon_image_path = str_replace('public/', '', $iconPath);
        }

        // Save the updated profile and user name
        $profile->save();
        $user->save();

        return redirect()->route('profile.edit')->with('success', 'プロフィールが更新されました。');
    }
}