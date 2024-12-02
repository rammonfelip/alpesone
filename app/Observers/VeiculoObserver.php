<?php
namespace App\Observers;

use App\Models\Veiculo;

class VeiculoObserver
{
    public function saving(Veiculo $veiculo)
    {
        $veiculo->id = $veiculo->id ?? Veiculo::all()->last()->id + 1;

        $veiculo->url_car = $veiculo->url_car ?? str_replace(
            ' ',
            '-',
            strtolower("{$veiculo->brand}-{$veiculo->model}-{$veiculo->year['build']}-{$veiculo->transmission}-{$veiculo->id}")
        );
    }
}
