<?php

namespace App\Http\Requests\Login;

use Illuminate\Foundation\Http\FormRequest;

class LoginUserRequest extends FormRequest
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
            'usuario'  => 'required',
            'senha' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'usuario.required' => 'O campo usuário é obrigatório!',
            'senha.required' => 'O campo senha é obrigatório!',
        ];
    }
}
