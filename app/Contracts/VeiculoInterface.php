<?php

namespace App\Contracts;

interface VeiculoInterface
{
    public function listarTodos();

    public function buscarPorId(int $id);

    public function criar(array $dados);

    public function atualizar(int $id, array $dados);

    public function deletar(int $id);
}
