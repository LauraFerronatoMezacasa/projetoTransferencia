<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAuthRequest extends FormRequest
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
            'email' => ['required', 'email'],
            'senha' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'O campo email é obrigatório!',
            'senha.required' => 'O campo senha é obrigatório!',
            'email.email' => 'Por favor, digite um email válido!',
           
        ];
    }
}
