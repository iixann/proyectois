<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model{
    
    use HasFactory;

    // Agregamos 'barcode' para que el escáner funcione
    protected $fillable = [
        'barcode',
        'name',
        'price',
        'stock',
    ];

    // Relación con los movimientos de stock (entradas y salidas)
    public function movements()
    {
        return $this->hasMany(StockMovement::class);
    }
}