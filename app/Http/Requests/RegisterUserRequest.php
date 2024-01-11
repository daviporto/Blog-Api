<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterUserRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'password' => 'required|min:6|string',
            'email' => 'required|email|unique:users,email,' . $this->user,
            'phone' => 'required|numeric|unique:users,phone,' . $this->user,
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => trans('user.name.required'),
            'password.required' => trans('user.password.required'),
            'password.min' => trans('user.password.min'),
            'email.required' => trans('user.email.required'),
            'email.email' => trans('user.email.email'),
            'email.unique' => trans('user.email.unique'),
            'phone.required' => trans('user.phone.required'),
            'phone.unique' => trans('user.phone.unique'),
            'phone.numeric' => trans('user.phone.numeric'),
            'phone.max' => trans('user.phone.max'),
        ];
    }
}
