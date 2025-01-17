<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'], // ユーザー名
            'email' => ['required', 'email', 'unique:users,email'], // メールアドレス
            'password' => ['required', 'string', 'min:8', 'confirmed'], // パスワード（確認用）
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'お名前を入力してください。',
            'email.required' => 'メールアドレスを入力してください。',
            'email.email' => '正しいメールアドレス形式で入力してください。',
            'email.unique' => 'このメールアドレスはすでに登録されています。',
            'password.required' => 'パスワードを入力してください。',
            'password.min' => 'パスワードは8文字以上で入力してください。',
            'password.confirmed' => 'パスワードと一致しません。',
        ];
    }
}
