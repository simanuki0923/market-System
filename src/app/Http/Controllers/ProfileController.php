<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function edit()
    {
        // Get the currently authenticated user
        $user = Auth::user();

        // Pass the user data to the view
        return view('profile', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        // Validate the incoming request data
        $request->validate([
            'name' => 'required|string|max:255',
            'postal_code' => 'required|string|max:10',
            'address' => 'required|string|max:255',
            'building' => 'nullable|string|max:255',
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle the file upload if a new icon is provided
        if ($request->hasFile('icon')) {
            // Delete the old icon if it exists
            if ($user->icon_url && Storage::exists($user->icon_url)) {
                Storage::delete($user->icon_url);
            }

            // Store the new icon and get its URL
            $path = $request->file('icon')->store('icons', 'public');
            $iconUrl = Storage::url($path);
        } else {
            $iconUrl = $user->icon_url;
        }

        // Update the user's profile information
        $user->update([
            'name' => $request->input('name'),
            'postal_code' => $request->input('postal_code'),
            'address' => $request->input('address'),
            'building' => $request->input('building'),
            'icon_url' => $iconUrl,
        ]);

        // Redirect back to the profile page with a success message
        return redirect()->route('profile.edit')->with('success', 'プロフィールが更新されました！');
    }
}