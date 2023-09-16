<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DeletePostRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
}
