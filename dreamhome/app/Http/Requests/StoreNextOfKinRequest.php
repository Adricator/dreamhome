<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreNextOfKinRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nok_name'         => ['required', 'string', 'max:255'],
            'nok_relationship' => ['required', 'string', 'max:100'],
            'nok_telephone_no' => ['required', 'string', 'max:50'],
            'nok_address'      => ['required', 'string', 'max:255'],
        ];
    }
}
