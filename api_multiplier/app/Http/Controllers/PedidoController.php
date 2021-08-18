<?php

namespace App\Http\Controllers;

use App\Models\PedidoModel as PedidoModel;
use App\Models\CardapioItemModel as CardapioItemModel;
use Illuminate\Http\Request;

class PedidoController extends Controller
{
    public function index($id_cliente, $id_mesa)
    {
        $itens = PedidoModel::select('*')
                    ->where('id_mesa', $id_mesa)
                    ->where(function ($query) {
                        $query->where('id_garcom',       '=', Auth::user()->id)
                              ->orWhere('id_cozinheiro', '=', Auth::user()->id);
                    })
                    ->get();
        if ($itens) {
            return response()->json($itens, 200);
        } else {
            return response()->json([], 404);
        }
    }

    public function store(Request $request, $id_cliente, $id_mesa)
    {
        $item = CardapioItemModel::find($request->id_item);
        $quantidade = $request->quantidade;

        $pedido = new PedidoModel;
        $pedido->status_pedido = 1; //1-A Fazer | 2-Em Andamento
        $pedido->id_cozinheiro = $request->id_cozinheiro;
        $pedido->id_garcom     = $request->id_garcom;
        $pedido->id_item       = $item->id;
        $pedido->id_mesa       = $id_mesa;
        $pedido->quantidade    = $quantidade;
        $pedido->total_pedido  = $quantidade * $item->preco_item;

        if ($pedido->save()) {
            return response()->json($pedido, 201);
        } else {
            return response()->json([
                'error' => "Erro ao Cadastrar"
            ], 500);
        }
    }

    public function show($id_cliente, $id_mesa, $id_pedido)
    {
        $item = PedidoModel::select('*')
                    ->where('id', $id_pedido)
                    ->where('id_mesa', $id_mesa)
                    ->get();
            
        if ($item) {
            return response()->json($item, 200);
        } else {
            return response()->json([], 404);
        }
    }

    public function update(Request $request, $id_cliente, $id_mesa, $id_pedido)
    {
        $item = PedidoModel::find([['id', $id_pedido], ['id_mesa', $id_mesa]])->first();

        if (is_null($item)) {
            return response()->json([], 404);
        } else {
            $item->status_pedido = $request->status_pedido;
            $update = $item->save();
            
            if ($update) {
                return response()->json($item, 201);
            } else {
                return response()->json([
                    'error' => "Erro ao Editar",
                ], 500);
            }
        }
    }

    public function destroy($id_cliente, $id_mesa, $id_pedido)
    {
        $item = PedidoModel::find([
            ['id', $id_pedido],
            ['id_mesa', $id_mesa],
            ['id_garcom', auth()->user()->id]
        ])->first();

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

    public function getTodosPedidosDoFuncionario() {
        $itens = PedidoModel::select('*')
                    ->where('id_garcom', '=', auth()->user()->id)
                    ->orWhere('id_cozinheiro', '=', auth()->user()->id)
                    ->get();
        if ($itens) {
            return response()->json($itens, 200);
        } else {
            return response()->json([], 404);
        }
    }

    public function getTodosPedidosGarcomEmAndamento() {
        $itens = PedidoModel::select('*')
                    ->where('id_garcom', '=', auth()->user()->id)
                    ->where('status_pedido', 2)
                    ->get();
        if ($itens) {
            return response()->json($itens, 200);
        } else {
            return response()->json([], 404);
        }
    }

    public function getTodosPedidosGarcomAFazer() {
        $itens = PedidoModel::select('*')
                    ->where('id_garcom', '=', auth()->user()->id)
                    ->where('status_pedido', 1)
                    ->get();
        if ($itens) {
            return response()->json($itens, 200);
        } else {
            return response()->json([], 404);
        }
    }

    public function getTodosPedidosCozinheiroEmAndamento() {
        $itens = PedidoModel::select('*')
                    ->where('id_cozinheiro', '=', auth()->user()->id)
                    ->where('status_pedido', 2)
                    ->get();
        if ($itens) {
            return response()->json($itens, 200);
        } else {
            return response()->json([], 404);
        }
    }

    public function getTodosPedidosCozinheiroAFazer() {
        $itens = PedidoModel::select('*')
                    ->where('id_cozinheiro', '=', auth()->user()->id)
                    ->where('status_pedido', 1)
                    ->get();
        if ($itens) {
            return response()->json($itens, 200);
        } else {
            return response()->json([], 404);
        }
    }

    public function getMaiorPedido($id_cliente) {
        $ped = PedidoModel::select('pedido.*')
                ->join('mesa', 'mesa.id', '=', 'pedido.id_mesa')
                ->join('cliente', 'cliente.id', '=', 'mesa.id_cliente')
                ->where('id_cliente', $id_cliente)
                ->orderby('pedido.total_pedido', 'desc')
                ->limit(1)
                ->get();
        if ($ped) {
            return response()->json($ped, 200);
        } else {
            return response()->json([], 404);
        }
    }

    public function getMenorPedido($id_cliente) {
        $ped = PedidoModel::select('pedido.*')
                ->join('mesa', 'mesa.id', '=', 'pedido.id_mesa')
                ->join('cliente', 'cliente.id', '=', 'mesa.id_cliente')
                ->where('id_cliente', $id_cliente)
                ->orderby('pedido.total_pedido')
                ->limit(1)
                ->get();
        if ($ped) {
            return response()->json($ped, 200);
        } else {
            return response()->json([], 404);
        }
    }

    public function getPrimeiroPedido($id_cliente) {
        $ped = PedidoModel::select('pedido.*')
                ->join('mesa', 'mesa.id', '=', 'pedido.id_mesa')
                ->join('cliente', 'cliente.id', '=', 'mesa.id_cliente')
                ->where('id_cliente', $id_cliente)
                ->orderby('pedido.id')
                ->limit(1)
                ->get();
        if ($ped) {
            return response()->json($ped, 200);
        } else {
            return response()->json([], 404);
        }
    }

    public function getUltimoPedido($id_cliente) {
        $ped = PedidoModel::select('pedido.*')
                ->join('mesa', 'mesa.id', '=', 'pedido.id_mesa')
                ->join('cliente', 'cliente.id', '=', 'mesa.id_cliente')
                ->where('id_cliente', $id_cliente)
                ->orderby('pedido.id', 'desc')
                ->limit(1)
                ->get();
        if ($ped) {
            return response()->json($ped, 200);
        } else {
            return response()->json([], 404);
        }
    }

    public function getAllPedidosCliente($id_cliente) {
        $ped = PedidoModel::select('pedido.*')
                ->join('mesa', 'mesa.id', '=', 'pedido.id_mesa')
                ->join('cliente', 'cliente.id', '=', 'mesa.id_cliente')
                ->where('id_cliente', $id_cliente)
                ->orderby('id', 'desc')
                ->get();
        if ($ped) {
            return response()->json($ped, 200);
        } else {
            return response()->json([], 404);
        }
    }

    public function getAllPedidosMesa($id_cliente, $id_mesa) {
        $ped = PedidoModel::select('mesa.id', 'pedido.*')
                ->join('mesa', 'mesa.id', '=', 'pedido.id_mesa')
                ->where('mesa.id', $id_mesa)
                ->where('mesa.id_cliente', $id_cliente)
                ->get();
        if ($ped) {
            return response()->json($ped, 200);
        } else {
            return response()->json([], 404);
        }
    }

    public function getPedidosPorMes($ano, $mes) {
        $ped = PedidoModel::select('mesa.id', 'pedido.*')
                ->join('mesa', 'mesa.id', '=', 'pedido.id_mesa')
                ->whereMonth('created_at', '=', $mes)
                ->whereYear('pedido.created_at', '=', $ano)
                ->get();
        if ($ped) {
            return response()->json($ped, 200);
        } else {
            return response()->json([], 404);
        }
    }

    public function getPedidosPorDia($ano, $mes, $dia) {
        $ped = PedidoModel::select('mesa.id', 'pedido.*')
                ->join('mesa', 'mesa.id', '=', 'pedido.id_mesa')
                ->whereYear('pedido.created_at', '=', $ano)
                ->whereMonth('pedido.created_at', '=', $mes)
                ->whereDay('pedido.created_at', '=', $dia)
                ->get();
        if ($ped) {
            return response()->json($ped, 200);
        } else {
            return response()->json([], 404);
        }
    }
}