<?php

namespace App\Rules;
use App\Models\Usuario;

use Illuminate\Contracts\Validation\Rule;

class UserEmail implements Rule
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
        $user = Usuario::where('id', auth()->user()->id)
        ->where('email', $value)
        ->first();
        if ($user != null){
            return true;
        }
        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'El email es incorrecto.';
    }
}
