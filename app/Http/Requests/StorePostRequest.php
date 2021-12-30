<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
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
            'content' => 'required|max:280',
        ];
    }

    public function messages()
    {
        return [
            'content.required'  => 'content cannot be empty',
            'content.max'  => 'content must be at most 280 characters',
        ];
    }
}
