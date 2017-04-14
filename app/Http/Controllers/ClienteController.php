<?php

namespace App\Http\Controllers;

use App\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{

    private $clientes;

    public function __construct(Cliente $cliente)
    {
        $this->clientes = $cliente;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clientes = $this->clientes->all();
        return response()->json([
            'data' => $clientes
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
            $cliente = new Cliente;
            $cliente->nome = $request->nome;
            $cliente->save();
            return response()->json([
                'data' => $cliente
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Erro ao cadastrar cliente. Por favor tente novamente.'
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
            $cliente = $this->clientes->findOrFail($id);
            return response()->json([
                'data' => $cliente
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Erro ao buscar cliente. Tente novamente.'
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
            $cliente = $this->clientes->findOrFail($id);
            $cliente->nome = $request->nome;
            $cliente->save();
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Erro ao atualizar cliente. Tente novamente.'
            ], 500);
        }
        return response()->json([
            'data' => $cliente
        ], 200);
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
            $cliente = $this->clientes->findOrFail($id);
            $cliente->delete();
            return response()->json([
                'data' => $cliente
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Erro ao deletar cliente. Tente novamente.'
            ], 500);
        }
    }
}
