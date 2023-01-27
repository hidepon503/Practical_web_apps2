<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientRequest extends FormRequest
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
            'name' => 'required|string|max:20',
            /*'keyword' => 'required|string|max:20',*/
        ];
    }

     public function messages()
    {
        return [
            'required' => "タスクを入力してください。",
            'name.max' => "20文字以内で入力してください。",
            /*'keyword.max' => "20文字以内で入力してください。"*/
        ];

    }
}
