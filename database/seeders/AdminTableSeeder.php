<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::create([
            'nome'      => 'Teste',
            'cpf'       => '160.653.310-07',
            'email'     => 'teste@gmail.com',
            'celular'   => '(41)95482-4566  ',
            'senha'     => bcrypt('123')
        ]);

        Admin::create([
            'nome'      => 'Artur',
            'cpf'       => '543.922.390-80',
            'email'     => 'arturbarbosaoliveira@gmail.com',
            'celular'   => '(41)99883-5770  ',
            'senha'     => bcrypt('123')
        ]);
    }
}
