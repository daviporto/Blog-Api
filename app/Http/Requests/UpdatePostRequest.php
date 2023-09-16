<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePostRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'content' => 'required|max:280',
            'title'   => 'string|max:50',
        ];
    }

    public function messages(): array
    {
        return [
            'content.required' => trans('post.content.required'),];
    }
}
