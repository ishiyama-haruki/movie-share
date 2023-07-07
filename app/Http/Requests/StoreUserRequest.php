<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Validation\Rules;

class StoreUserRequest extends FormRequest
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
            'name' => 'required|max:10|unique:users',
            'email' => 'required|email|string|unique:users',
            'password' => 'required|unique:users|confirmed|between:5,10',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'ユーザー名を入力してください',
            'name.unique' => 'このユーザー名はすでに使用されています',
            'name.max' => 'ユーザー名は10文字以下で入力してください',
            'email.required' => 'メールアドレスを入力してください',
            'email.email' => 'メールアドレスの形式が不適切です',
            'email.unique' => 'このメールアドレスはすでに使用されています',
            'password.required' => 'パスワードを入力してください',
            'password.unique' => 'このパスワードはすでに使用されています',
            'password.between' => 'パスワードは5文字以上10文字以下で設定してください',
            'password.confirmed' => '確認用パスワードが一致していません'
        ];
    }
}
