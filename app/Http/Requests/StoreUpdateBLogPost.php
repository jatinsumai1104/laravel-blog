<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateBLogPost extends FormRequest
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
            'title' => ['required', 'max:255x'],
            'short_description' => ['required', 'max:255'],
            'tags' => ['required'],
            'content' => ['required'],
            'image' => ['mimes:jpeg,bmp,png', 'file', 'max:400']
        ];
    }
}
