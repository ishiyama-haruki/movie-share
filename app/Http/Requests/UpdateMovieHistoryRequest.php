<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMovieHistoryRequest extends FormRequest
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
            'evaluation' => 'required',
            'viewing_date' => 'required',
            'place' => 'required',
            'impression' => 'required|max:255',
            'accessible' => 'required',
            'viewing_count' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'viewing_date.required' => '視聴日は必ず入力してください',
            'viewing_count.required' => '視聴回数は必ず入力してください',
            'impression.required' => '感想は必ず入力してください',
            'impression.max' => '感想は255文字以下で入力してください',
        ];
    }
}
