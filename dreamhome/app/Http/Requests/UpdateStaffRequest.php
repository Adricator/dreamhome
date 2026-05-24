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
            'dob'          => 'required|date|before:today', // Added DOB validation
            'sex'          => 'required|in:male,female',
            
            // Contact Details
            'email'        => 'required|email|max:255', // Added Email validation
            'telephone_no' => 'required|string|max:20',
            'address'      => 'required|string',        // Added Address validation
            
            // Employment & Assignment
            'position'     => 'required|in:manager,supervisor,secretary,staff',
            'salary'       => 'required|numeric|min:0',
            'branch_id'    => 'required|exists:branches,branch_id',
            'nin'          => 'required|string|unique:staff,nin,' . $staff_id . ',staff_id',

            // Role-Specific Conditional Fields (Made nullable so they don't break for other roles)
            'car_allowance'     => 'nullable|numeric|min:0',
            'performance_bonus' => 'nullable|numeric|min:0',
            'typing_speed_wpm'  => 'nullable|integer|min:0',
            'supervised_by'     => 'nullable|exists:staff,staff_id',
        ];
    }
}
