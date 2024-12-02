<?php

namespace App\Console\Commands;

use App\Models\Veiculo;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class UpdateVeiculos extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'veiculos:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Recupera e atualiza os veículos via integração com a API';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        try {
            $provider = config('provider.api.alpesone');
            $response = Http::get($provider);

            if ($response->failed()) {
                $this->error('Falha ao acessar a API.');
                return;
            }

            $content = $response->json();
            $contentHash = md5(json_encode($content));

            if (Cache::has('veiculos') && Cache::get('veiculos') == $contentHash) {
                $this->info('Nenhuma alteração nos registros.');
                return;
            }

            $fileName = "veiculos.json";

            Cache::put('veiculos', $contentHash);

            Storage::put($fileName, json_encode($content));

            $file = Storage::get($fileName);
            $data = [];

            foreach (json_decode($file) as $veiculo) {
                foreach ($veiculo as $key => $value) {
                    if (is_array($value) || is_object($value)) {
                        $data[$key] = json_encode($value);
                    } else {
                        $data[$key] = $value;
                    }
                }

                Veiculo::updateOrCreate(
                    ['id' => $data['id']],
                    $data
                );
            }

            $this->info('Registros armazenados e atualizados.');
        } catch (\Throwable $th) {
            $this->error("Erro: {$th->getMessage()}");
        }
    }
}
