<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableCardapio extends Migration
{
    public function up()
    {
        Schema::create('cardapio', function (Blueprint $table) {
            $table->id();
            $table->string('nome_cardapio', 255);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('cardapio');
    }
}