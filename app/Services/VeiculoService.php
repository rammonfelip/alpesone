<?php

namespace App\Services;

use App\Contracts\VeiculoInterface;
use App\Models\Veiculo;

class VeiculoService implements VeiculoInterface
{
    public function listarTodos()
    {
        return Veiculo::all();
    }

    public function buscarPorId(int $id)
    {
        return Veiculo::findOrFail($id);
    }

    public function criar(array $dados)
    {
        return Veiculo::create($dados);
    }

    public function atualizar(int $id, array $dados)
    {
        $veiculo = Veiculo::findOrFail($id);
        $veiculo->update($dados);

        return $veiculo;
    }

    public function deletar(int $id)
    {
        $veiculo = Veiculo::findOrFail($id);
        $veiculo->delete();

        return true;
    }
}
