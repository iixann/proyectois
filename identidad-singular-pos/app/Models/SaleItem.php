<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory; // Agregamos esto por buena práctica

class SaleItem extends Model
{
    use HasFactory;

    // Esto le dice a Laravel qué campos puede llenar automáticamente
    protected $fillable = [
        'sale_id', 
        'product_id', 
        'quantity', 
        'price'
    ];

    // Relación: Este ítem pertenece a una venta
    public function sale()
    {
        return $this->belongsTo(Sale::class);
    }

    // Relación: Este ítem pertenece a un producto (el vino específico)
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}