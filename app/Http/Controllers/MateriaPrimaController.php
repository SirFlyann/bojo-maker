<?php

namespace App\Http\Controllers;

use App\MateriaPrima;
use Illuminate\Http\Request;

class MateriaPrimaController extends Controller
{

    private $materias;

    public function __construct(MateriaPrima $materias)
    {
        $this->materias = $materias;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $materias = $this->materias->all();
        return response()->json([
            'data' => $materias
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
            $materia = new MateriaPrima;
            $materia->nome = $request->nome;
            $materia->quantidade = $request->quantidade;
            $materia->medida = $request->medida;
            $materia->save();
            return response()->json([
                'data' => $materia
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Erro ao cadastrar matéria prima! Por favor tente novamente.'
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
            $materia = $this->materias->findOrFail($id);
            return response()->json([
                'data' => $materia
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Erro ao buscar matéria prima. Tente novamente.'
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
            $materia = $this->materias->findOrFail($id);
            $materia->nome = $request->nome;
            $materia->quantidade = $request->quantidade;
            $materia->medida = $request->medida;
            $materia->save();
            return response()->json([
                'data' => $materia
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Erro ao atualizar matéria prima. Tente novamente.'
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
            $materia = $this->materias->findOrFail($id);
            $materia->delete();
            return response()->json([
                'data' => $materia
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Erro ao deletar matéria prima. Tente novamente.'
            ], 500);
        }
    }
}
