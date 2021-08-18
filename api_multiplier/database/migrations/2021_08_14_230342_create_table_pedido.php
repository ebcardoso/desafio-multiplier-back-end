<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTablePedido extends Migration
{
    public function up()
    {
        Schema::create('pedido', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_garcom')->unsigned();
            $table->bigInteger('id_cozinheiro')->unsigned();
            //$table->bigInteger('id_mesa')->unsigned();
            $table->foreignId('id_mesa')->references('id')->on('mesa')->onDelete('cascade');
            //$table->bigInteger('id_item')->unsigned();
            $table->foreignId('id_item')->references('id')->on('cardapio_item')->onDelete('cascade');
            $table->integer('quantidade');
            $table->integer('status_pedido'); //1-A Fazer | 2-Em Andamento
            $table->decimal('total_pedido', 10, 2);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pedido');
    }
}