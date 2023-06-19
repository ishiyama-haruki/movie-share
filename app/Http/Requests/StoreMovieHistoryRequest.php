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
            'evaluation' => 'required',
            'viewing_date' => 'required',
            'place' => 'required',
            'impression' => 'required',
            'overview' => 'required',
            'release_date' => 'required',
            'img_path' => 'required',
            'user_id' => 'required',
        ];
    }
}
