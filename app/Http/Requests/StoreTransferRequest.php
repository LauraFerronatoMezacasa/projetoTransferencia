<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTransferRequest extends FormRequest
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
            'cpfcnpj' => 'required',
            'valor' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'cpfcnpj.required' => 'O campo CPF/CNPJ é obrigatório!',
            'valor.required' => 'O campo valor é obrigatório!',
        ];
    }

    public function validationData()
    {
        $data = $this->all();

        $data['cpfcnpj'] = str_replace(["/", ".", "-"], "", $data['cpfcnpj']);

        return $data;
    }
}
