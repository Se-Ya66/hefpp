<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
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
            'title' => 'required|max:50',
            'body' => 'required|max:300',
            'conditions' => 'required|max:300',
            'type' => 'required',
            'prefecture' => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'title' => 'タイトル',
            'body' => '詳細',
            'conditions' => '条件',
            'type' => '種別',
            'prefecture' => '都道府県',
        ];
    }
}
