<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterUserRequest extends FormRequest
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
            'name' => 'required',
            'password' => 'required|min:6|string',
            'email' => 'required|email|unique:users,email,' . $this->user,
            'phone' => 'required|numeric|unique:users,phone,' . $this->user,
        ];
    }

    public function messages()
    {
        return [
            'name.required'  => 'name cannot be empty ',
            'password.required'  => 'password cannot be empty ',
            'password.min' => 'password must be at least 6 characters',
            'email.required'  => 'email cannot be empty ',
            'email.email'  => 'email is invalid',
            'email.unique'  => 'email already in use ',
            'phone.required'  => 'phone cannot be empty ',
            'phone.unique'  => 'phone already in use ',
            'phone.numeric' => 'phone must be only numbers'
        ];
    }
}
