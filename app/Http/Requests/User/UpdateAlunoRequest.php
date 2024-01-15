<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAlunoRequest extends FormRequest
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
            'cpf' => 'required|cpf',
            'email' => 'required|email',
            'celular' => 'required',
            'data_nascimento'  => 'required',
        ];
    }

    public function messages()
    {
        return [
            'nome.required' => 'O campo nome é obrigatório!',
            'cpf.required' => 'O campo cpf é obrigatório!',
            'email.required' => 'O campo email é obrigatório!',
            'celular.required' => 'O campo celular é obrigatório!',
            'email.email' => 'Email inválido!',
            'data_nascimento.required' => 'O campo Data de nascimento é obrigatório!',
        ];
    }
}

