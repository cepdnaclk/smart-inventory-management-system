<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Services\DepartmentDataService;

class ValidateAsInternalEmail implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        // Skip email validator in unit testing, to save time 
        if (app()->environment() == 'testing') return true;
        $api = new DepartmentDataService();
        return $api->isUserExists($value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return  "Only Department of Computer Engineering students/staff are allowed to register by themself.";
    }
}
