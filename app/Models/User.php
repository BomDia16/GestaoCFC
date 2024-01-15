<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;

    protected $table = 'users';

    protected $fillable = [
        'nome', 'cpf', 'email', 'celular', 'senha', 'usuario', 'cfc_id'
    ];

    public function getAuthPassword() {
        return $this->senha;
    }

    public function login($dados) {
        $credenciais = [
            'usuario' => $dados['usuario'],
            'password' => $dados['senha']
        ];
        return Auth::attempt($credenciais);
    }

    public function logout() {
        return Auth::logout();
    }

    public function inserir($dados) {
        $cadastrar = $this->create([
            'nome'          => $dados['nome'],
            'email'         => $dados['email'],
            'cpf'           => $dados['cpf'],
            'celular'       => $dados['celular'],
            'usuario'       => $dados['usuario'],
            'cfc_id'        => $dados['cfc_id'],
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

    public function searchUser(Array $data, $totalPage) {
        return $this->where(function($query) use ($data) {
            if (isset($data['id']))
                $query->where('id', $data['id']);

            if (isset($data['nome']))
                $query->where('nome', $data['nome']);
        })->paginate($totalPage);
    }
}
