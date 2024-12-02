<?php

namespace App\Providers;

use App\Contracts\VeiculoInterface;
use App\Models\Veiculo;
use App\Observers\VeiculoObserver;
use App\Services\VeiculoService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(VeiculoInterface::class, VeiculoService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Veiculo::observe(VeiculoObserver::class);
    }
}
