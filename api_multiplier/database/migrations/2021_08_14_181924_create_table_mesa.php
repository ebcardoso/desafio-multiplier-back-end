<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableMesa extends Migration
{
    public function up()
    {
        Schema::create('mesa', function (Blueprint $table) {
            $table->id();
            //$table->bigInteger('id_cliente')->unsigned();
            $table->foreignId('id_cliente')->references('id')->on('cliente')->onDelete('cascade');
            $table->string("numero_mesa", 255);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('mesa');
    }
}