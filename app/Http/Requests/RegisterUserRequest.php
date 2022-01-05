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
            'name.required'  => 'nome não pode ser vazio',
            'password.required'  => 'senha não pode ser vazia',
            'password.min' => ' senha deve conter pelo menos 6 caracteres',
            'email.required'  => 'email não pode ser vazio ',
            'email.email'  => 'email inválido',
            'email.unique'  => 'email já está em use ',
            'phone.required'  => 'telefone não pode ser vazio',
            'phone.unique'  => 'telefone já está em use ',
            'phone.numeric' => 'telefone deve conter apenas números',
            'phone.max' => 'telefone deve conter 12 números',
        ];
    }
}
