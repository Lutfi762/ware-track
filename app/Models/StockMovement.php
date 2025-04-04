<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockMovement extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'quantity',
        'movement_type', // e.g., 'in' or 'out'
        'created_at',
        'updated_at',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}