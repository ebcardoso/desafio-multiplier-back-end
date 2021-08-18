<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CardapioController;
use App\Http\Controllers\CardapioItemController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\MesaController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\UserAuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::post('register', [UserAuthController::class,'registerUserExample']);
Route::post('login', [UserAuthController::class,'loginUserExample']);
Route::middleware('auth:api')->get('/user', [UserAuthController::class,'authenticatedUserDetails']);
Route::get('/notauth', [UserAuthController::class,'userNotAuth'])->name('user.notauth');

Route::middleware('auth:api')->get('/user/gettodospedidosdofuncionario', [PedidoController::class, 'getTodosPedidosDoFuncionario']);
Route::middleware('auth:api')->get('/user/gettodospedidosgarcomemandamento', [PedidoController::class, 'getTodosPedidosGarcomEmAndamento']);
Route::middleware('auth:api')->get('/user/gettodospedidosgarcomafazer', [PedidoController::class, 'getTodosPedidosGarcomAFazer']);
Route::middleware('auth:api')->get('/user/gettodospedidoscozinheiroemandamento', [PedidoController::class, 'getTodosPedidosCozinheiroEmAndamento']);
Route::middleware('auth:api')->get('/user/gettodospedidoscozinheiroafazer', [PedidoController::class, 'getTodosPedidosCozinheiroAFazer']);

Route::middleware('auth:api')->get('/cardapio',  [CardapioController::class, 'index']);
Route::middleware('auth:api')->get('/cardapio/{id_cardapio}', [CardapioController::class, 'show']);
Route::middleware('auth:api')->post('/cardapio', [CardapioController::class, 'store']);
Route::middleware('auth:api')->put('/cardapio/{id_cardapio}', [CardapioController::class, 'update']);
Route::middleware('auth:api')->delete('/cardapio/{id_cardapio}', [CardapioController::class, 'destroy']);

Route::middleware('auth:api')->get('/cardapio/{id_cardapio}/item', [CardapioItemController::class, 'index']);
Route::middleware('auth:api')->get('/cardapio/{id_cardapio}/item/{id_item}', [CardapioItemController::class, 'show']);
Route::middleware('auth:api')->post('/cardapio/{id_cardapio}/item', [CardapioItemController::class, 'store']);
Route::middleware('auth:api')->put('/cardapio/{id_cardapio}/item/{id_item}', [CardapioItemController::class, 'update']);
Route::middleware('auth:api')->delete('/cardapio/{id_cardapio}/item/{id_item}', [CardapioItemController::class, 'destroy']);

Route::middleware('auth:api')->get('/cliente',  [ClienteController::class, 'index']);
Route::middleware('auth:api')->get('/cliente/{id_cliente}', [ClienteController::class, 'show']);
Route::middleware('auth:api')->post('/cliente', [ClienteController::class, 'store']);
Route::middleware('auth:api')->put('/cliente/{id_cliente}', [ClienteController::class, 'update']);
Route::middleware('auth:api')->delete('/cliente/{id_cliente}', [ClienteController::class, 'destroy']);
Route::middleware('auth:api')->get('/cliente/{id_cliente}/getmaiorpedido', [PedidoController::class, 'getMaiorPedido']);
Route::middleware('auth:api')->get('/cliente/{id_cliente}/getmenorpedido', [PedidoController::class, 'getMenorPedido']);
Route::middleware('auth:api')->get('/cliente/{id_cliente}/getprimeiropedido', [PedidoController::class, 'getPrimeiroPedido']);
Route::middleware('auth:api')->get('/cliente/{id_cliente}/getultimopedido', [PedidoController::class, 'getUltimoPedido']);
Route::middleware('auth:api')->get('/cliente/{id_cliente}/getallpedidoscliente', [PedidoController::class, 'getAllPedidosCliente']);


Route::middleware('auth:api')->get('/cliente/{id_cliente}/mesa', [MesaController::class, 'index']);
Route::middleware('auth:api')->get('/cliente/{id_cliente}/mesa/{id_mesa}', [MesaController::class, 'show']);
Route::middleware('auth:api')->get('/cliente/{id_cliente}/mesa/{id_mesa}/getallpedidosmesa', [PedidoController::class, 'getAllPedidosMesa']);
Route::middleware('auth:api')->post('/cliente/{id_cliente}/mesa', [MesaController::class, 'store']);
Route::middleware('auth:api')->put('/cliente/{id_cliente}/mesa/{id_mesa}', [MesaController::class, 'update']);
Route::middleware('auth:api')->delete('/cliente/{id_cliente}/mesa/{id_mesa}', [MesaController::class, 'destroy']);

Route::middleware('auth:api')->get('/cliente/{id_cliente}/mesa/{id_mesa}/pedido', [PedidoController::class, 'index']);
Route::middleware('auth:api')->get('/cliente/{id_cliente}/mesa/{id_mesa}/pedido/{id_pedido}', [PedidoController::class, 'show']);
Route::middleware('auth:api')->post('/cliente/{id_cliente}/mesa/{id_mesa}/pedido', [PedidoController::class, 'store']);
Route::middleware('auth:api')->put('/cliente/{id_cliente}/mesa/{id_mesa}/pedido/{id_pedido}', [PedidoController::class, 'update']);
Route::middleware('auth:api')->delete('/cliente/{id_cliente}/mesa/{id_mesa}/pedido/{id_pedido}', [PedidoController::class, 'destroy']);

Route::middleware('auth:api')->get('/pedido/getpedidospormes/{ano}/{mes}', [PedidoController::class, 'getPedidosPorMes']);
Route::middleware('auth:api')->get('/pedido/getpedidospordia/{ano}/{mes}/{dia}', [PedidoController::class, 'getPedidosPorDia']);