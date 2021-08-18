<?php

namespace App\Http\Controllers;

use App\Models\MesaModel as MesaModel;
use Illuminate\Http\Request;

class MesaController extends Controller
{
    public function index($id_cliente)
    {
        $mesas = MesaModel::select('*')->where('id_cliente', $id_cliente)->get();
        if ($mesas) {
            return response()->json($mesas, 200);
        } else {
            return response()->json([], 404);
        }
    }
    
    public function store(Request $request, $id_cliente)
    {
        $mesa = new MesaModel;
        $mesa->id_cliente = $id_cliente;
        $mesa->numero_mesa = $request->numero_mesa;
        $mesa->total_mesa = 0;

        if ($mesa->save()) {
            return response()->json($mesa, 201);
        } else {
            return response()->json([
                'error' => "Erro ao Cadastrar"
            ], 500);
        }
    }

    public function show($id_cliente, $id_mesa)
    {
        $mesa = MesaModel::select('*')
                    ->where('id_cliente', $id_cliente)
                    ->where('id', $id_mesa)
                    ->get();
        if ($mesa) {
            return response()->json($mesa, 200);
        } else {
            return response()->json([], 404);
        }
    }

    public function update(Request $request, $id_cliente, $id_mesa)
    {
        $mesa = MesaModel::find([['id', $id_mesa], ['id_cliente', $id_cliente]])->first();

        if (is_null($mesa)) {
            return response()->json([], 404);
        } else {
            $mesa->numero_mesa = $request->numero_mesa;
            $update = $mesa->save();
            
            if ($update) {
                return response()->json($mesa, 200);
            } else {
                return response()->json([
                    'error' => "Erro ao Editar",
                ], 500);
            }
        }
    }

    public function destroy($id_cliente, $id_mesa)
    {
        $mesa = MesaModel::find([['id', $id_mesa], ['id_cliente', $id_cliente]])->first();

        if (is_null($mesa)) {
            return response()->json([], 404);
        } else {   
            $delete = $mesa->delete();
            
            if ($delete) {
                return response()->json($mesa, 200);
            } else {
                return response()->json([
                    'error' => "Erro ao Deletar",
                ], 500);
            }
        }
    }
}