<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'password' => 'required|min:6|string',
            'email' => 'required|email|exists:users,email',
        ];
    }

    public function messages(): array
    {
        return [
            'password.required' => trans('user.password.required'),
            'password.min' => trans('user.password.min'),
            'email.required' => trans('user.email.required'),
            'email.email' => trans('user.email.email'),
            'email.exists' => trans('user.email.exists'),
        ];
    }
}
