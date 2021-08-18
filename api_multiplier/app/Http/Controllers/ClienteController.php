<?php

namespace App\Http\Controllers;

use App\Models\ClienteModel as ClienteModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ClienteController extends Controller
{
    public function index()
    {
        $clis = ClienteModel::All();
        if ($clis) {
            return response()->json($clis, 200);
        } else {
            return response()->json([], 404);
        }
    }

    public function store(Request $request)
    {
        $rules =  [
            'nome_cliente' => 'required',
            'cpf_cliente' => 'required',
        ];
        $messages = [
            'nome_cliente.required' => 'O atributo nome_cliente é obrigatório!',
            'cpf_cliente.required' => 'O atributo cpf_cliente é obrigatório!',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 500);
        }

        $cli = new ClienteModel;
        $cli->nome_cliente = $request->nome_cliente;
        $cli->cpf_cliente = $request->cpf_cliente;

        if ($cli->save()) {
            return response()->json($cli, 201);
        } else {
            return response()->json([
                'error' => "Erro ao Cadastrar"
            ], 500);
        }
    }

    public function show($id_cliente)
    {
        $cli = ClienteModel::find($id_cliente);
        if ($cli) {
            return response()->json($cli, 200);
        } else {
            return response()->json([], 500);
        }
    }

    public function update(Request $request, $id_cliente)
    {
        $rules =  [
            'nome_cliente' => 'required',
            'cpf_cliente' => 'required',
        ];
        $messages = [
            'nome_cliente.required' => 'O atributo nome_cliente é obrigatório!',
            'cpf_cliente.required' => 'O atributo cpf_cliente é obrigatório!',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 500);
        }
        
        $cli = ClienteModel::find($id_cliente);
        
        if (is_null($cli)) {
            return response()->json([], 404);
        } else {
            $cli->nome_cliente = $request->nome_cliente;
            $cli->cpf_cliente = $request->cpf_cliente;
            $update = $cli->save();
            
            if ($update) {
                return response()->json($cli, 200);
            } else {
                return response()->json([
                    'error' => "Erro ao Editar",
                ], 500);
            }
        }
    }

    public function destroy($id_cliente)
    {
        $cli = ClienteModel::find($id_cliente);

        if (is_null($cli)) {
            return response()->json([], 404);
        } else {   
            $delete = $cli->delete();
            
            if ($delete) {
                return response()->json($cli, 200);
            } else {
                return response()->json([
                    'error' => "Erro ao Deletar",
                ], 500);
            }
        }
    }
}