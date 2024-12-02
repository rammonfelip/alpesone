<?php

namespace App\Http\Controllers;

use App\Contracts\VeiculoInterface;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VeiculoController extends Controller
{
    protected $veiculoService;

    public function __construct(VeiculoInterface $veiculoService)
    {
        $this->veiculoService = $veiculoService;
    }

    public function index()
    {
        return response()->json($this->veiculoService->listarTodos(), Response::HTTP_OK);
    }

    public function show($id)
    {
        return response()->json($this->veiculoService->buscarPorId($id), Response::HTTP_OK);
    }

    public function store(Request $request)
    {
        $dados = $request->all();

        return response()->json($this->veiculoService->criar($dados), Response::HTTP_CREATED);
    }

    public function update(Request $request, $id)
    {
        $dados = $request->all();

        return response()->json($this->veiculoService->atualizar($id, $dados), Response::HTTP_OK);
    }

    public function destroy($id)
    {
        $this->veiculoService->deletar($id);
        return response()->json(['message' => 'Veículo removido com sucesso'], Response::HTTP_OK);
    }
}
