<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SendMailRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
             'recipient_email' => 'required|email',
            'subject' => 'required|string|max:255',
            'message' => 'required|string'
        ];
    }

    public function messages()
    {
        return [
            'recipient_email.required' => 'メールアドレスを入力してください。',
            'recipient_email.email' => '有効なメールアドレスを入力してください。',
            'subject.required' => '件名を入力してください。',
            'message.required' => 'メッセージを入力してください。',
        ];
    }
}
