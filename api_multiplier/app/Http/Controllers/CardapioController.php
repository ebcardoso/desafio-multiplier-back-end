<?php

namespace App\Http\Controllers;

use App\Models\CardapioModel as CardapioModel;
use App\Http\Resources\Cardapio as CardapioResource;
use Illuminate\Http\Request;

class CardapioController extends Controller
{
    public function index()
    {
        $cards = CardapioModel::All();
        if ($cards) {
            return response()->json($cards, 200);
        } else {
            return response()->json(['error' => 'Not Found'], 404);
        }
    }

    public function store(Request $request)
    {
        /*$validated = $request->validate([
            'nome_cardapio' => 'required|max:255'
        ]);*/

        $card = new CardapioModel;
        $card->nome_cardapio = $request->nome_cardapio;

        if ($card->save()) {
            return response()->json($card, 201);
        } else {
            return response()->json([
                'error' => "Erro ao Cadastrar"
            ], 500);
        }
    }

    public function show($id_cardapio)
    {
        $card = CardapioModel::find($id_cardapio);
        if ($card) {
            return response()->json($card, 200);
        } else {
            return response()->json([], 404);
        }
    }

    public function update(Request $request, $id_cardapio)
    {
        $card = CardapioModel::find($id_cardapio);
        
        if (is_null($card)) {
            return response()->json([], 404);
        } else {
            $card->nome_cardapio = $request->nome_cardapio;
            $update = $card->save();

            if ($update) {
                return response()->json($card, 201);
            } else {
                return response()->json([
                    'error' => "Erro ao Editar",
                ], 500);
            }
        }
    }

    public function destroy($id_cardapio)
    {
        $card = CardapioModel::find($id_cardapio);

        if (is_null($card)) {
            return response()->json([], 404);
        } else {   
            $delete = $card->delete();
            
            if ($delete) {
                return response()->json($card, 200);
            } else {
                return response()->json([
                    'error' => "Erro ao Deletar",
                ], 500);
            }
        }
    }
}