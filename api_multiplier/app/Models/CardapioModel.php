<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CardapioModel extends Model
{
    protected $table = "cardapio";
    
    protected $fillable = [
        'nome_cardapio'
    ];
}