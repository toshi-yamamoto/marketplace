<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentRequest extends FormRequest
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
        // dd('バリデーションが適用されています');
        return [
            'content' => 'required|string|max:255', // 入力必須、最大255文字
        ];
    }

    public function messages()
    {
        return [
            'content.required' => 'コメントは必須です。',
            'content.string' => 'コメントは文字列で入力してください。',
            'content.max' => 'コメントは255文字以内で入力してください。',
        ];
    }
}
