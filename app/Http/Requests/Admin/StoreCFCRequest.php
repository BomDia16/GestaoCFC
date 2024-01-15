<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreCFCRequest extends FormRequest
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
            'nome'  => 'required',
            'email' => 'required|email',
            'celular' => 'required',
            'cnpj' => 'required|cnpj',
            'razao-social' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'nome.required' => 'O campo nome é obrigatório!',
            'email.required' => 'O campo email é obrigatório!',
            'celular.required' => 'O campo celular é obrigatório!',
            'cnpj.required' => 'O campo cnpj é obrigatório!',
            'razao-social.required' => 'O campo razão social é obrigatório!',
            'email.email' => 'Email inválido!',
        ];
    }
}
