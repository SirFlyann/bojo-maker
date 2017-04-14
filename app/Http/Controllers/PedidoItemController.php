<?php

namespace App\Http\Controllers;

use App\Produto;
use App\PedidoItem;
use App\ProdutoMateria;
use Illuminate\Http\Request;

class PedidoItemController extends Controller
{

    private $pedidosItens;
    private $produtos;
    private $materias;

    public function __construct(PedidoItem $pedidosItens, Produto $produtos, ProdutoMateria $materias)
    {
        $this->pedidosItens = $pedidosItens;
        $this->produtos = $produtos;
        $this->materias = $materias;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $produto = $this->produtos->findOrFail($request->produto_id);

        $margem = $request->quantidade * 1.1;
        $p = ceil($margem / 8);
        $resultadoTecido = $p*0.4;
        $resultadoEspuma = $p*1.2;

        $materias = $this->materias->where('produto_id', $produto->id)->get();
        $espuma = $materias->get(0)->materia;
        $tecido = $materias->get(1)->materia;

        if ($espuma->quantidade < $resultadoEspuma || $tecido->quantidade < $resultadoTecido) {
            return response()->json([
                'message' => 'Não há matéria prima suficiente para fazer esta quantidade de ' . $produto->nome
            ], 403);
        }

        $espuma->quantidade -= $resultadoEspuma;
        $espuma->save();

        $tecido->quantidade -= $resultadoTecido;
        $tecido->save();

        $pedidoItem = new PedidoItem;
        $pedidoItem->pedido_id = $request->pedido_id;
        $pedidoItem->produto_id = $request->produto_id;
        $pedidoItem->quantidade = $request->quantidade;
        $pedidoItem->save();
        return response()->json([
            'data' => $pedidoItem
        ], 200);
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
            $pedidoItem = $this->pedidosItens->findOrFail($id);
            return response()->json([
                'data' => $pedidoItem
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Erro ao buscar item de pedido. Tente novamente.'
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
            $pedidoItem = $this->pedidosItens->findOrFail($id);
            $pedidoItem->pedido_id = $request->pedido_id;
            $pedidoItem->produto_id = $request->produto_id;
            $pedidoItem->quantidade = $request->quantidade;
            $pedidoItem->save();
            return response()->json([
                'data' => $pedidoItem
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Erro ao atualizar item de pedido. Por favor tente novamente.'
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
            $pedidoItem = $this->pedidosItens->findOrFail($id);
            $pedidoItem->delete();
            return response()->json([
                'data' => $pedidoItem
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Erro ao deletar item de pedido. Tente novamente.'
            ], 500);
        }
    }
}
