<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class StockMovement extends Model
{
    use HasFactory;

    const MOVEMENT_TYPE_IN = 'in';
    const MOVEMENT_TYPE_OUT = 'out';

    protected $fillable = [
        'product_id',
        'quantity',
        'movement_type', // e.g., 'in' or 'out'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // Validasi movement type
    public static function isValidMovementType($type)
    {
        return in_array($type, [self::MOVEMENT_TYPE_IN, self::MOVEMENT_TYPE_OUT]);
    }

    // Scope untuk mengambil pergerakan stok hari ini
    public function scopeToday($query)
    {
        return $query->whereDate('created_at', Carbon::today());
    }
}