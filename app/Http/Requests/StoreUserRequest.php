<?php

namespace App\Http\Requests;

use App\Rules\FullName;
use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'nome' => ['required', new FullName],
            'email' => ['required', 'email', 'unique:users,email'],
            'cpfcnpj' => ['required', 'cpf_cnpj', 'unique:users,cpf_cnpj'],
            'senha' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'nome.required' => 'O campo nome é obrigatório!',
            'email.required' => 'O campo email é obrigatório!',
            'cpfcnpj.required' => 'O campo CPF/CNPJ é obrigatório!',
            'senha.required' => 'O campo senha é obrigatório!',
            'email.email' => 'Por favor, digite um email válido!',
            'email.unique' => 'Este email já está sendo utilizado!',
            'cpfcnpj.unique' => 'Este CPF/CNPJ já está sendo utilizado!',
        ];
    }

    public function validationData()
    {
        $data = $this->all();

        $data['cpfcnpj'] = str_replace(["/", ".", "-"], "", $data['cpfcnpj']);

        return $data;
    }
}
