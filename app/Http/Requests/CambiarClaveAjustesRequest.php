<?php

namespace App\Http\Requests;

use App\Rules\UserClave;
use App\Rules\TextGameRule;
use Illuminate\Foundation\Http\FormRequest;

class CambiarClaveAjustesRequest extends FormRequest
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
            'claveSeguridad' => [new UserClave()],
            'claveSeguridadNueva' => ['required', 'min:6', 'max:20', new TextGameRule()],
            'claveSeguridadRepeat' => ['required', 'min:6', 'max:20', 'required_with:claveSeguridadNueva', 'same:claveSeguridadNueva', new TextGameRule()]
        ];
    }
}
