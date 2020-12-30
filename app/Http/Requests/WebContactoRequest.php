<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WebContactoRequest extends FormRequest
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
            'nombre' => 'required|min:2|max:50',
            'email' => 'required|email|max:50',
            'subject' => 'required|min:6|max:100',
            'contenido' => 'required|min:6|max:255',
        ];
    }
}
