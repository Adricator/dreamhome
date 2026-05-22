<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateStaffRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Must be true!
    }
    
    public function rules(): array
    {
        // Fetch the route parameter matching what you mapped in web.php
        $staff_id = $this->route('staff_id'); 
    
        return [
            'first_name'   => 'required|string|max:255',
            'last_name'    => 'required|string|max:255',
            'sex'          => 'required|in:male,female',
            'position'     => 'required|string|max:255',
            'salary'       => 'required|numeric',
            'telephone_no' => 'required|string',
            'branch_id'    => 'required|exists:branches,branch_id',
            // This ensures validation passes even if the user leaves their current NIN unchanged
            'nin'          => 'required|string|unique:staff,nin,' . $staff_id . ',staff_id',
        ];
    }
}
