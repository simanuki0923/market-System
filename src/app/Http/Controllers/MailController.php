<?php

namespace App\Http\Controllers;

use App\Models\Mail;
use App\Models\User;
use App\Http\Requests\SendMailRequest;
use Illuminate\Support\Facades\Mail as MailFacade;

class MailController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showForm()
    {
        return view('admin.mail');
    }

    public function sendMail(SendMailRequest $request)
    {
        $user = User::where('email', $request->recipient_email)->first();
        
        if (!$user) {
            return redirect()->route('admin.showMailForm')
                             ->with('error', '指定されたメールアドレスは登録されていません。');
        }

        Mail::create([
            'user_id' => $user->id,
            'recipient_email' => $request->recipient_email,
            'subject' => $request->subject,
            'message' => $request->message,
        ]);

        MailFacade::raw($request->message, function ($message) use ($request) {
            $message->to($request->recipient_email)
                    ->subject($request->subject);
        });

        return redirect()->route('admin.showMailForm')
                         ->with('success', 'メールを送信致しました。');
    }
}