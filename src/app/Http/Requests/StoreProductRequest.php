<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
             'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'category' => 'required|string|max:255',
            'condition' => 'required|string|max:50'
        ];
    }

    public function messages()
    {
        return [
            'image.image' => 'アップロードするファイルは画像でなければなりません。',
            'image.mimes' => '画像はjpeg、png、jpg形式でなければなりません。',
            'image.max' => '画像のサイズは2MB以下でなければなりません。',
            'name.required' => '名前は必須です。',
            'name.string' => '名前は文字列でなければなりません。',
            'name.max' => '名前は255文字以内で入力してください。',
            'description.required' => '説明は必須です。',
            'description.string' => '説明は文字列でなければなりません。',
            'price.required' => '価格は必須です。',
            'price.numeric' => '価格は数値でなければなりません。',
            'price.min' => '価格は0以上でなければなりません。',
            'category.required' => 'カテゴリーは必須です。',
            'category.string' => 'カテゴリーは文字列でなければなりません。',
            'category.max' => 'カテゴリーは255文字以内で入力してください。',
            'condition.required' => '商品の状態は必須です。',
            'condition.string' => '商品の状態は文字列でなければなりません。',
            'condition.max' => '商品の状態は50文字以内で入力してください。',
        ];
    }
}
