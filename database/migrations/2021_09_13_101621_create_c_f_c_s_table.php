<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCFCSTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('c_f_c_s', function (Blueprint $table) {
            $table->id();
            $table->string('cnpj', 20);
            $table->string('razão_social', 191);
            $table->string('nome', 191);
            $table->string('email', 191);
            $table->string('celular', 14);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('c_f_c_s');
    }
}
