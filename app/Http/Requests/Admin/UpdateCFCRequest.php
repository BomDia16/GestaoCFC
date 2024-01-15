<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCFCRequest extends FormRequest
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
            'cnpj' => 'required|cnpj',
            'email' => 'required|email',
            'celular' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'nome.required' => 'O campo nome é obrigatório!',
            'cnpj.required' => 'O campo cnpj é obrigatório!',
            'email.required' => 'O campo email é obrigatório!',
            'celular.required' => 'O campo celular é obrigatório!',
            'email.email' => 'Email inválido!',
        ];
    }
}

