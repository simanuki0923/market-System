<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminLoginRequest;
use Illuminate\Support\Facades\Auth;

class AdminLoginController extends Controller
{
    public function create()
    {
        return view('admin.login');
    }

    public function store(AdminLoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('admins')->attempt($credentials)) {
            $admin = Auth::guard('admins')->user();

            if ($admin->role == 'admins') {
              return redirect()->intended('/admin');
          } else {
              Auth::guard('admins')->logout();
              return back()->withErrors([
                'name' => 'You do not have the necessary permissions.',
              ]);
          }
       }

        return back()->withErrors([
            'name' => 'The provided credentials do not match our records.',
        ]);
    }

    public function destroy()
    {
        Auth::guard('admins')->logout();
        return redirect()->route('admin.login');
    }
}
