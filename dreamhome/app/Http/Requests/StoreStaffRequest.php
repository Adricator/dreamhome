<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\StoreNextOfKinRequest;

class StoreStaffRequest extends FormRequest
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
        $staffRules = [
        // Ensure ALL of these are explicitly listed here so they populate the $validated array
            'first_name'   => ['required', 'string', 'max:255'],
            'last_name'    => ['required', 'string', 'max:255'],
            'dob'          => ['required', 'date'], // <-- MAKE SURE THIS LINE IS PRESENT
            'email'        => ['nullable', 'email', 'max:255'],
            'telephone_no' => ['nullable', 'string', 'max:50'],
            'address'      => ['required', 'string', 'max:255'],
            'position'     => ['required', 'string'],
            'salary'       => ['nullable', 'numeric'],
            'nin'          => ['nullable', 'string', 'max:50'],
            'sex'          => ['required', 'string'],
            'branch_id'    => ['nullable', 'string', 'max:10'],
            // Your remaining conditional fields follow...
            'car_allowance'     => ['nullable', 'numeric', 'min:0'],
            'performance_bonus' => ['nullable', 'numeric', 'min:0'],
            'typing_speed_wpm'  => ['nullable', 'integer', 'min:0'],
            'supervised_by'     => ['nullable', 'string'],
        ];
        $nokRules = (new StoreNextOfKinRequest())->rules();

        return array_merge($staffRules, $nokRules);
    }

    public function attributes(): array
    {
        return [
            'staff_id'          => 'Staff ID',
            'car_allowance'     => 'Car Allowance',
            'performance_bonus' => 'Performance Bonus',
            'typing_speed_wpm'  => 'Typing Speed',
            'supervised_by'     => 'Supervising Manager ID',
        ];
    }
}
