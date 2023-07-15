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
            'name' => 'required',
            'password' => 'required|min:6|string',
            'email' => 'required|email|unique:users,email,' . $this->user,
            'phone' => 'required|numeric|unique:users,phone,' . $this->user,
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => trans('validation.name.required'),
            'password.required' => trans('validation.password.required'),
            'password.min' => trans('validation.password.min'),
            'email.required' => trans('validation.email.required'),
            'email.email' => trans('validation.email.email'),
            'email.unique' => trans('validation.email.unique'),
            'phone.required' => trans('validation.phone.required'),
            'phone.unique' => trans('validation.phone.unique'),
            'phone.numeric' => trans('validation.phone.numeric'),
            'phone.max' => trans('validation.phone.max'),
        ];
    }
}
