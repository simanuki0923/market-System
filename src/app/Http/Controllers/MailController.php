<?php

namespace App\Http\Controllers;

use App\Models\Mail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail as MailFacade;

class MailController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // Authentication middleware
    }

    // Show the form to send emails
    public function showForm()
    {
        return view('admin.mail');
    }

    // Handle the form submission and send the email
    public function sendMail(Request $request)
    {
        // Validate the request
        $request->validate([
            'recipient_email' => 'required|email',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        $user = User::where('email', $request->recipient_email)->first();
        
        if (!$user) {
            return redirect()->route('admin.showMailForm')
                             ->with('error', '指定されたメールアドレスは登録されていません。');
        }

        // Save the mail information in the database
        Mail::create([
            'user_id' => $user->id,
            'recipient_email' => $request->recipient_email,
            'subject' => $request->subject,
            'message' => $request->message,
        ]);

        // Send the email
        MailFacade::raw($request->message, function ($message) use ($request) {
            $message->to($request->recipient_email)
                    ->subject($request->subject);
        });

        return redirect()->route('admin.showMailForm')
                         ->with('success', 'メールを送信致しました。');
    }
}