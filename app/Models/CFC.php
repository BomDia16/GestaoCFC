<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CFC extends Model
{
    use HasFactory;

    protected $table = 'c_f_c_s';

    protected $fillable = [
        'nome', 'cnpj', 'email', 'celular', 'razão_social'
    ];
    
    public function inserir($dados) {
        $cadastrar = $this->create([
            'nome'          => $dados['nome'],
            'email'         => $dados['email'],
            'cnpj'          => $dados['cnpj'],
            'celular'       => $dados['celular'],
            'razão_social'  => $dados['razao-social'],
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

    public function searchCFC(Array $data, $totalPage) {
        return $this->where(function($query) use ($data) {
            if (isset($data['id']))
                $query->where('id', $data['id']);

            if (isset($data['nome']))
                $query->where('nome', $data['nome']);
        })->paginate($totalPage);
    }
}
