<?php

namespace App\Http\Requests;

use App\Rules\TextGameRule;
use Illuminate\Foundation\Http\FormRequest;

class RegistroRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //Hay cambiar el regex
            'nombre' => ['required', 'unique:usuarios,nombre', 'max:13', new TextGameRule()],
            'email' => 'required|email',
            'password' => ['required', 'min:6', 'max:20', new TextGameRule()],

            'passwordRepeat' => ['required','min:6','max:20','required_with:password','same:password', new TextGameRule()],
            'avatar' => 'required',
            'terminos' => 'required',
        ];
    }
}
