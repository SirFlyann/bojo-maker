<?php

namespace App\Http\Controllers;

use App\Pedido;
use App\PedidoItem;
use Illuminate\Http\Request;

class PedidoController extends Controller
{

    private $pedidos;

    public function __construct(Pedido $pedidos)
    {
        $this->pedidos = $pedidos;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pedidos = $this->pedidos->all();
        return response()->json([
            'data' => $pedidos
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $pedido = new Pedido;
            $pedido->cliente_id = $request->cliente_id;
            $pedido->save();
            return response()->json([
                'data' => $pedido
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Erro ao cadastrar pedido. Por favor tente novamente.'
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function get($id)
    {
        try {
            $pedido = $this->pedidos->findOrFail($id);
            $pedidosItens = $pedido->itens;
            return response()->json([
                'data' => ['pedido' => $pedido, 'itens' => $pedidosItens]
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Erro ao buscar pedido. Tente novamente.'
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $pedido = $this->pedidos->findOrFail($id);
            $pedido->nome = $request->nome;
            $pedido->save();
            return response()->json([
                'data' => $pedido
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Erro ao atualizar pedido. Tente novamente.'
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $pedido = $this->pedidos->findOrFail($id);
            $pedido->delete();
            return response()->json([
                'data' => $pedido
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Erro ao deletar pedido. Tente novamente.'
            ], 500);
        }
    }
}
