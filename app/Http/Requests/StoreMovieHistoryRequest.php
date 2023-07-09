<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMovieHistoryRequest extends FormRequest
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
            'title' => 'required|max:255',
            'original_title' => 'required|max:255',
            'evaluation' => 'required',
            'viewing_date' => 'required',
            'accessible' => 'required',
            'place' => 'required',
            'impression' => 'required|max:255',
            'overview' => 'required',
            'release_date' => 'required',
            'img_path' => 'nullable',
            'youtube_id' => 'nullable',
        ];

        return [
            'name.required' => '感想は必ず入力してください',
            'name.max' => '感想は255文字以内で入力してください',
        ];
    }

}
