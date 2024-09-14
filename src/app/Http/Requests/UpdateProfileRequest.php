<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'icon_image' => 'nullable|image|max:2048',
            'postal_code' => 'nullable|string|max:10',
            'address' => 'nullable|string|max:255',
            'building' => 'nullable|string|max:255',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '名前は必須です。',
            'name.string' => '名前は文字列でなければなりません。',
            'name.max' => '名前は255文字以内でなければなりません。',
            'icon_image.image' => 'アイコン画像は画像ファイルでなければなりません。',
            'icon_image.max' => 'アイコン画像は2MB以内でなければなりません。',
            'postal_code.string' => '郵便番号は文字列でなければなりません。',
            'postal_code.max' => '郵便番号は10文字以内でなければなりません。',
            'address.string' => '住所は文字列でなければなりません。',
            'address.max' => '住所は255文字以内でなければなりません。',
            'building.string' => '建物名は文字列でなければなりません。',
            'building.max' => '建物名は255文字以内でなければなりません。',
        ];
    }
}
