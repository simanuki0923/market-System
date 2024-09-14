<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAddressRequest extends FormRequest
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
             'postal_code' => 'required|string|max:7',
            'address' => 'required|string|max:255',
            'building' => 'nullable|string|max:255',
        ];
    }

    public function messages()
    {
        return [
            'postal_code.required' => '郵便番号は必須です。',
            'postal_code.string' => '郵便番号は文字列である必要があります。',
            'postal_code.max' => '郵便番号は7文字以内で入力してください。',
            'address.required' => '住所は必須です。',
            'address.string' => '住所は文字列である必要があります。',
            'address.max' => '住所は255文字以内で入力してください。',
            'building.string' => '建物名は文字列である必要があります。',
            'building.max' => '建物名は255文字以内で入力してください。',
        ];
    }
}
