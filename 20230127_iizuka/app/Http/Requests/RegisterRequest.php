<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules;

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
            'name' => ['required', 'string',  'max:191'],
            'email' => ['required', 'string', 'email', 'min:8', 'max:191', 'unique:users'],
            'password' => ['required', 'min:8', 'max:191','confirmed', Rules\Password::defaults()],
        ];
    }

      public function messages()
    {
        return [
            'neme.required' => "名前を入力してください。",
            'name.max' => "191文字以内で入力してください。",
            'email.required' => "emailを入力してください。",
            'email.max' => "191文字以内で入力してください。",
            'email.min' => "8文字以上で入力してください。",
            'password.required' => "パスワードを入力してください。",
            'password.max' => "191文字以内で入力してください。",
            'password.min' => "8文字以上で入力してください。",
        ];

    }
}
