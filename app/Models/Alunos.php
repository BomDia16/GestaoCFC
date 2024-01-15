<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alunos extends Model
{
    use HasFactory;

    protected $table = 'alunos';

    protected $fillable = [
        'nome', 'cpf', 'email', 'celular', 'cfc_id', 'data_nascimento', 'carteira_categoria', 'cfc_pertencente'
    ];

    public function cfc() {
        return $this->belongsTo(
            'App\Models\CFC', 'cfc_id'
        );
    }

    public function inserir($dados) {
        $cadastrar = $this->create([
            'nome'              => $dados['nome'],
            'email'             => $dados['email'],
            'cpf'               => $dados['cpf'],
            'celular'           => $dados['celular'],
            'cfc_pertencente'   => $dados['cfc_id'],
            'data_nascimento'   => $dados['data_nascimento'],
            'carteira_categoria'=> $dados['tipo_carteira'],
            'cfc_id'            => auth()->user()->id,
        ]);

        if($cadastrar){
            return [
                'status' => true,
                'message' => 'Sucesso ao cadastrar o aluno!'
            ];
        } else {
            return [
                'status' => false,
                'message' => 'Falha ao cadastrar o aluno!',
            ];
        }
    }

    public function searchAluno(Array $data, $totalPage) {
        return $this->where(function($query) use ($data) {
            if (isset($data['id']))
                $query->where('id', $data['id']);

            if (isset($data['nome']))
                $query->where('nome', $data['nome']);
        })->paginate($totalPage);
    }
}
