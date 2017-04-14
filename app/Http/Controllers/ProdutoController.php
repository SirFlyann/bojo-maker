<?php

namespace App\Http\Controllers;

use App\Produto;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{

    private $produtos;
    private $produtoMaterias;

    public function __construct(Produto $produtos)
    {
        $this->produtos = $produtos;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $produtos = $this->produtos->all();
        return response()->json([
            'data' => $produtos
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
            $produto = new Produto;
            $produto->nome = $request->nome;
            $produto->save();
            return response()->json([
                'data' => $produto
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Erro ao cadastrar produto. Por favor tente novamente.'
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
            $produto = $this->produtos->findOrFail($id);
            $materias = $produto->materiasPrimas;
            return response()->json([
                'data' => ['produto' => $produto, 'materias' => $materias ]
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Erro ao buscar produto. Tente novamente.'
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
            $produto = $this->produtos->findOrFail($id);
            $produto->nome = $request->nome;
            $produto->save();
            return response()->json([
                'data' => $produto
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Erro ao atualizar produto. Tente novamente.'
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
            $produto = $this->produtos->findOrFail($id);
            $produto->delete();
            return response()->json([
                'data' => $produto
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Erro ao deletar produto. Tente novamente.'
            ], 500);
        }
    }
}
