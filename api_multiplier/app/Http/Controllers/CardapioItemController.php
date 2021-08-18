<?php

namespace App\Http\Controllers;

use App\Models\CardapioItemModel as CardapioItemModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CardapioItemController extends Controller
{
    public function index($id_cardapio)
    {
        $itens = CardapioItemModel::select('*')->where('id_cardapio', $id_cardapio)->get();
        if ($itens) {
            return response()->json($itens, 200);
        } else {
            return response()->json([], 404);
        }
    }

    public function store(Request $request, $id_cardapio)
    {
        $rules =  [
            'nome_item' => 'required',
            'preco_item' => 'required',
        ];
        $messages = [
            'nome_item.required' => 'O atributo nome_item é obrigatório!',
            'preco_item.required' => 'O atributo preco_item é obrigatório!',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 500);
        }

        $item = new CardapioItemModel;
        $item->id_cardapio = $id_cardapio;
        $item->nome_item = $request->nome_item;
        $item->preco_item = $request->preco_item;

        if ($item->save()) {
            return response()->json($item, 201);
        } else {
            return response()->json([
                'error' => "Erro ao Cadastrar"
            ], 500);
        }
    }

    public function show($id_cardapio, $id_item)
    {
        $item = CardapioItemModel::select('*')
                    ->where('id_cardapio', $id_cardapio)
                    ->where('id', $id_item)
                    ->get();
        if ($item) {
            return response()->json($item, 201);
        } else {
            return response()->json([], 500);
        }
    }

    public function update(Request $request, $id_cardapio, $id_item)
    {
        $rules =  [
            'nome_item' => 'required',
            'preco_item' => 'required',
        ];
        $messages = [
            'nome_item.required' => 'O atributo nome_item é obrigatório!',
            'preco_item.required' => 'O atributo preco_item é obrigatório!',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 500);
        }

        $item = CardapioItemModel::find([['id', $id_item], ['id_cardapio', $id_cardapio]])->first();

        if (is_null($item)) {
            return response()->json([], 404);
        } else {
            $item->nome_item = $request->nome_item;
            $item->preco_item = $request->preco_item;
            $update = $item->save();
            
            if ($update) {
                return response()->json($item, 200);
            } else {
                return response()->json([
                    'error' => "Erro ao Editar",
                ], 500);
            }
        }
    }

    public function destroy($id_cardapio, $id_item)
    {
        $item = CardapioItemModel::find([['id', $id_item], ['id_cardapio', $id_cardapio]])->first();

        if (is_null($item)) {
            return response()->json([], 404);
        } else {   
            $delete = $item->delete();
            
            if ($delete) {
                return response()->json($item, 200);
            } else {
                return response()->json([
                    'error' => "Erro ao Deletar",
                ], 500);
            }
        }
    }
}