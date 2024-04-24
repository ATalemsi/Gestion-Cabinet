<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class CustomDateFormat implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        // Check if the date format matches "Y-m-d\TH:i" (e.g., "2024-09-15T11:30")
        return preg_match('/^\d{4}-\d{2}-\d{2}T\d{2}:\d{2}$/', $value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute field must be in the format "Y-m-d\TH:i" (e.g., "2024-09-15T11:30").';
    }
}
