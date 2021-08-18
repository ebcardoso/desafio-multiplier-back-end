<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\CardapioModel;
use App\Models\CardapioItemModel;

class CardapioSeeder extends Seeder
{
    public function run()
    {
        //DB::table('cardapio')->truncate();

        $faker = Faker::create();
        $faker->addProvider(new \FakerRestaurant\Provider\pt_BR\Restaurant($faker));
        for ($i = 0; $i < 10; $i++) {
            $cardapio = new CardapioModel;
            $cardapio->nome_cardapio = $faker->firstNameFemale;
            $cardapio->save();
            
            for ($j = 0; $j < 10; $j++) {
                $item = new CardapioItemModel;
                $item->id_cardapio = $cardapio->id;
                $item->nome_item   = $faker->foodName();
                $item->preco_item  = $faker->randomFloat($nbMaxDecimals = 2, $min = 1, $max = 10);
                $item->save();
            }
        }

        $faker = Faker::create();
        $faker->addProvider(new \FakerRestaurant\Provider\de_DE\Restaurant($faker));
        for ($i = 0; $i < 10; $i++) {
            $cardapio = new CardapioModel;
            $cardapio->nome_cardapio = $faker->firstNameFemale;
            $cardapio->save();
            
            for ($j = 0; $j < 10; $j++) {
                $item = new CardapioItemModel;
                $item->id_cardapio = $cardapio->id;
                $item->nome_item   = $faker->foodName();
                $item->preco_item  = $faker->randomFloat($nbMaxDecimals = 2, $min = 1, $max = 10);
                $item->save();
            }
        }

        $faker = Faker::create();
        $faker->addProvider(new \FakerRestaurant\Provider\en_US\Restaurant($faker));
        for ($i = 0; $i < 10; $i++) {
            $cardapio = new CardapioModel;
            $cardapio->nome_cardapio = $faker->firstNameFemale;
            $cardapio->save();
            
            for ($j = 0; $j < 10; $j++) {
                $item = new CardapioItemModel;
                $item->id_cardapio = $cardapio->id;
                $item->nome_item   = $faker->foodName();
                $item->preco_item  = $faker->randomFloat($nbMaxDecimals = 2, $min = 1, $max = 10);
                $item->save();
            }
        }

        $faker = Faker::create();
        $faker->addProvider(new \FakerRestaurant\Provider\es_PE\Restaurant($faker));
        for ($i = 0; $i < 10; $i++) {
            $cardapio = new CardapioModel;
            $cardapio->nome_cardapio = $faker->firstNameFemale;
            $cardapio->save();
            
            for ($j = 0; $j < 10; $j++) {
                $item = new CardapioItemModel;
                $item->id_cardapio = $cardapio->id;
                $item->nome_item   = $faker->foodName();
                $item->preco_item  = $faker->randomFloat($nbMaxDecimals = 2, $min = 1, $max = 10);
                $item->save();
            }
        }

        $faker = Faker::create();
        $faker->addProvider(new \FakerRestaurant\Provider\fr_FR\Restaurant($faker));
        for ($i = 0; $i < 10; $i++) {
            $cardapio = new CardapioModel;
            $cardapio->nome_cardapio = $faker->firstNameFemale;
            $cardapio->save();
            
            for ($j = 0; $j < 10; $j++) {
                $item = new CardapioItemModel;
                $item->id_cardapio = $cardapio->id;
                $item->nome_item   = $faker->foodName();
                $item->preco_item  = $faker->randomFloat($nbMaxDecimals = 2, $min = 1, $max = 10);
                $item->save();
            }
        }
    }
}