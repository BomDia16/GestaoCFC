<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlunosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alunos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('cfc_id');
            $table->string('nome', 191);
            $table->string('cpf', 14);
            $table->string('email', 191);
            $table->string('celular', 14);
            $table->string('data_nascimento', 191);
            $table->enum('carteira_categoria', ['A', 'B', 'C', 'D', 'E']);
            $table->foreignId('cfc_pertencente');
            $table->timestamps();

            // Foreign's Key
            $table->foreign('cfc_id')->references('id')->on('users');
            $table->foreign('cfc_pertencente')->references('id')->on('cfcs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('alunos');
    }
}
