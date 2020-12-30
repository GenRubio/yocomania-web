<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\TextGameRule;

class RecoverPasswordValidateRequest extends FormRequest
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
            'passwordRecover' => ['required','min:6','max:20', new TextGameRule()],
            'passwordRepiteRecover' => ['required','min:6','max:20','required_with:passwordRecover','same:passwordRecover', new TextGameRule()]
        ];
    }
}
