<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\Usuario;

class UserClave implements Rule
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
        ->first();
        
        if ($user->security != ""){
            if ($user->security == $value){
                return true;
            }
        }
        else{
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
        return 'La clave de seguridad es incorrecta.';
    }
}
