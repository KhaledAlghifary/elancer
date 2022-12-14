<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class FilterRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    protected $name;
    public function __construct($name)
    {
        //

        $this->name=$name;
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
        //writing the logic of valdition and it returns treu or false
        if($value == $this->name){
            return false;
        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'This word is not allowed to use';
    }
}
