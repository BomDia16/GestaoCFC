<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Admin extends Authenticatable
{
    protected $table = 'admins';

    protected $fillable = [
        'nome', 'cpf', 'email', 'celular', 'senha'
    ];

    public function getAuthPassword() {
        return $this->senha;
    }

    public function login($dados) {
        $credenciais = [
            'cpf' => $dados['cpf'],
            'password' => $dados['senha']
        ];
        return Auth::guard('admin')->attempt($credenciais);
    }

    public function logout() {
        return Auth::guard('admin')->logout();
    }

    public function inserir($dados) {
        $cadastrar = $this->create([
            'nome'          => $dados['nome'],
            'email'         => $dados['email'],
            'cpf'           => $dados['cpf'],
            'celular'       => $dados['celular'],
            'senha'         => bcrypt($dados['senha']),
        ]);

        if($cadastrar){
            return [
                'status' => true,
                'message' => 'Sucesso ao cadastrar o admin!'
            ];
        } else {
            return [
                'status' => false,
                'message' => 'Falha ao cadastrar o admin!',
            ];
        }
    }

    public function searchAdmin(Array $data, $totalPage) {
        return $this->where(function($query) use ($data) {
            if (isset($data['id']))
                $query->where('id', $data['id']);

            if (isset($data['nome']))
                $query->where('nome', 'LIKE', "%{$data['nome']}%");
        })->paginate($totalPage);
    }
}