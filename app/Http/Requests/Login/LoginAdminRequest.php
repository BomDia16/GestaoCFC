<?php

namespace App\Http\Requests\Login;

use Illuminate\Foundation\Http\FormRequest;

class LoginAdminRequest extends FormRequest
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
            'cpf' => 'required|cpf',
            'senha' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'cpf.required' => 'O campo cpf é obrigatório!',
            'senha.required' => 'O campo senha é obrigatório!',
        ];
    }
}
