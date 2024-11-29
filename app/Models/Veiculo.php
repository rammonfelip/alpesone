<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Veiculo extends Model
{
    protected $fillable = [
        'id', 'type', 'brand', 'model', 'version', 'year', 'optionals', 'doors', 'board', 'chassi', 'transmission', 'km',
        'description', 'created', 'updated', 'sold', 'category', 'url_car', 'old_price', 'price', 'color', 'fuel', 'fotos',
    ];
}
