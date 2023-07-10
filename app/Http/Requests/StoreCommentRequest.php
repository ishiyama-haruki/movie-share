<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCommentRequest extends FormRequest
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
            'user_id' => 'required',
            'movie_history_id' => 'required',
            'message' => 'required|max:255'
        ];
    }

    public function messages()
    {
        return [
            'message.required' => 'コメント内容は必ず入力してください',
            'message.max' => 'コメント内容は255文字以下で入力してください',
        ];
    }
}
