<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('veiculos:update', function () {
    $this->comment(Inspiring::quote());
})->purpose('Verificando e atualizando registros')->hourly();
