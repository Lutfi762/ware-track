<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Carbon\Carbon;

class Transaction extends Model
{
    use HasFactory;
    
    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'product_id', // ID produk yang terlibat dalam transaksi
        'transaction_type', // Jenis transaksi (in/out)
        'quantity', // Jumlah barang yang masuk atau keluar
        'transaction_date', // Tanggal dan waktu transaksi
        'description', // Deskripsi tambahan (opsional)
    ];

    /**
     * details
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function details()
    {
        return $this->hasMany(TransactionDetail::class);
    }

    /**
     * customer
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * transactionSummary
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function transactionSummary()
    {
        return $this->hasMany(TransactionSummary::class);
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