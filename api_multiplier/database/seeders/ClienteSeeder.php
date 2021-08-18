<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\ClienteModel;
use App\Models\MesaModel;
use App\Models\PedidoModel;
use App\Models\CardapioItemModel;

class ClienteSeeder extends Seeder
{
    public function run()
    {
        //DB::table('cliente')->truncate();

        $faker = Faker::create('pt_BR');

        for ($i = 0; $i < 100; $i++) {
            $cliente = new ClienteModel;
            $cliente->nome_cliente = $faker->name;
            $cliente->cpf_cliente  = $faker->cpf;
            $cliente->save();

            for ($j = 0; $j < 5; $j++) {
                $mesa = new MesaModel;
                $mesa->id_cliente  = $cliente->id;
                $mesa->numero_mesa = 'm0'.$faker->numberBetween($min = 1, $max = 99999);
                $mesa->save();

                for ($k = 0; $k < 8; $k++) { 
                    $item = CardapioItemModel::find($faker->numberBetween($min = 1, $max = 500));

                    $pedido = new PedidoModel;
                    $pedido->id_mesa       = $mesa->id;
                    $pedido->id_item       = $item->id;
                    $pedido->id_garcom     = $faker->numberBetween($min = 1, $max = 10);
                    $pedido->id_cozinheiro = $faker->numberBetween($min = 11, $max = 20);
                    $pedido->quantidade    = $faker->numberBetween($min = 1, $max = 10);
                    $pedido->total_pedido  = $pedido->quantidade * $item->preco_item;
                    $pedido->status_pedido = $faker->numberBetween($min = 1, $max = 2);
                    $pedido->save();
                }
            }
        }
    }
}