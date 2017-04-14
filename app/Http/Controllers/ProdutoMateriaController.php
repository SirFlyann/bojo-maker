<?php

namespace App\Http\Controllers;

use App\ProdutoMateria;
use Illuminate\Http\Request;

class ProdutoMateriaController extends Controller
{

    private $produtoMaterias;

    public function __construct(ProdutoMateria $produtoMaterias)
    {
        $this->produtoMaterias = $produtoMaterias;
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
            $produtoMateria = new ProdutoMateria;
            $produtoMateria->produto_id = $request->produto_id;
            $produtoMateria->materia_id = $request->materia_id;
            $produtoMateria->save();
            return response()->json([
                'data' => $produtoMateria
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Erro ao relacionar produto com matéria prima. Por favor tente novamente'
            ], 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function get($id)
    {
        try {
            $produtoMateria = $this->findOrFail($id);
            return response()->json([
                'data' => $produtoMateria
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Erro ao recuperar relacionamento entre produto e matéria prima. Por favor tente novamente'
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
            $produtoMateria = $this->produtoMaterias->findOrFail($id);
            $produtoMateria->produto_id = $request->produto_id;
            $produtoMateria->materia_id = $request->materia_id;
            $produtoMateria->save();
            return response()->json([
                'data' => $produtoMateria
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Erro ao atualizar relacionamento entre produto e matéria. Tente novamente.'
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
            $produtoMateria = $this->produtoMaterias->findOrFail($id);
            $produtoMateria->delete();
            return response()->json([
                'data' => $produtoMateria
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Erro ao remover relacionamento entre produto e matéria prima. Por favor tente novamente.'
            ], 500);
        }
    }
}
