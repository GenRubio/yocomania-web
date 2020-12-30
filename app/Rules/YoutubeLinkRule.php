<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class YoutubeLinkRule implements Rule
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
        /*if (str_contains($value, 'youtu.be/')) {
            return true;
        }*/
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'El enlace de video es incorrecto.';
    }
}
