<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;

class TransactionSummary extends Model
{
    use HasFactory;

    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'total_in',      // Total jumlah barang yang masuk
        'total_out',     // Total jumlah barang yang keluar
        'net_balance',    // Selisih antara total_in dan total_out
    ];
    /**
     * transaction
     *
     * @return void
     */
    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }
     /**
     * createdAt
     *
     * @return Attribute
     */
    protected function createdAt(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => Carbon::parse($value)->format('d-M-Y H:i:s'),
        );
    }
}