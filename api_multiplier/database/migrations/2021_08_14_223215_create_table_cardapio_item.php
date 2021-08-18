<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableCardapioItem extends Migration
{
    public function up()
    {
        Schema::create('cardapio_item', function (Blueprint $table) {
            $table->id();
            //$table->bigInteger('id_cardapio')->unsigned();
            $table->foreignId('id_cardapio')->references('id')->on('cardapio')->onDelete('cascade');
            $table->string('nome_item', 255);
            $table->decimal('preco_item', 10, 2);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('cardapio_item');
    }
}