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
        $provider = 'https://brasilapi.com.br/api/ibge/municipios/v1/PB';//config('provider.api.alpesone');
        $response = Http::get($provider);
        $content = $response->json();
        $contentHash = md5(json_encode($content));

        if (Cache::has('veiculos') && Cache::get('veiculos') == $contentHash) {
            return 'Registros atualizados';
        }

        $fileName = "alpesone.json";

        Cache::put('veiculos', md5(json_encode($content)));
        Storage::put($fileName, $content);
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

            Veiculo::updateOrCreate([
                'id' => $data['id']
            ], $data);
        }

        return 'Registros armazenados';
    }
}
