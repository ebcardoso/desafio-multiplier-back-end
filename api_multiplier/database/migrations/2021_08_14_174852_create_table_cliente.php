<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableCliente extends Migration
{
    public function up()
    {
        Schema::create('cliente', function (Blueprint $table) {
            $table->id();
            $table->string('nome_cliente', 255);
            $table->string('cpf_cliente', 255);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('cliente');
    }
}