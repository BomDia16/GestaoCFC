<?php

namespace App\Http\Requests\Admin;

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
            'nome'  => 'required',
            'cpf' => 'required|cpf',
            'email' => 'required|email',
            'celular' => 'required',
            'senha' => 'required',
            'usuario'  => 'required',
            'cfc_id'  => 'required',
        ];
    }

    public function messages()
    {
        return [
            'nome.required' => 'O campo nome é obrigatório!',
            'cpf.required' => 'O campo cpf é obrigatório!',
            'email.required' => 'O campo email é obrigatório!',
            'celular.required' => 'O campo celular é obrigatório!',
            'senha.required' => 'O campo senha é obrigatório!',
            'email.email' => 'Email inválido!',
            'usuario.required' => 'O campo usuário é obrigatório!',
            'cfc_id.required' => 'O campo CFC Id é obrigatório!',
        ];
    }
}
