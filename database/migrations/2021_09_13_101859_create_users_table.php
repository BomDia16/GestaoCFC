<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('cfc_id');
            $table->string('nome');
            $table->string('cpf', 14);
            $table->string('email')->unique();
            $table->string('celular', 14);
            $table->string('usuario', 191);
            $table->string('senha', 191);
            $table->rememberToken();
            $table->timestamps();

            // Foreign's Key
            $table->foreign('cfc_id')->references('id')->on('cfcs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
