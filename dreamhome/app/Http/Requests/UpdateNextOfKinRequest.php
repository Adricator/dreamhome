<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateNextOfKinRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Ensure this is set to true
    }

    public function rules(): array
    {
        return [
            'nok_name'         => ['required', 'string', 'max:255'],
            'nok_relationship' => ['required', 'string', 'max:100'],
            'nok_telephone_no' => ['required', 'string', 'max:20'],
            'nok_address'      => ['required', 'string'],
        ];
    }
}
