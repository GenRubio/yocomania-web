<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\TextGameRule;
use App\Rules\UserPassword;

class CambiarPasswordAjustesRequest extends FormRequest
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
            'password' => ['required', new UserPassword()],
            'passwordNueva' => ['required', 'min:6', 'max:20', new TextGameRule()],
            'passwordRepeat' => ['required', 'min:6', 'max:20', 'required_with:passwordNueva', 'same:passwordNueva', new TextGameRule()]
        ];
    }
}
