<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'name' => 'required|max:10',
            'email' => 'required|email|string|unique:users,email,' . $this->id . ',id',
            'image' => 'nullable',
            'comment' => 'nullable|max:255'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '名前を入力してください',
            'name.max' => 'ユーザー名は10文字以下で入力してください',
            'email.required' => 'メールアドレスを入力してください',
            'email.email' => 'メールアドレスの形式が不適切です',
            'email.unique' => 'このメールアドレスはすでに使用されています',
            'comment.max' => '本文は255文字以下で入力してください',
        ];
    }
}
