<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    
     public function up()
     {
         Schema::create('transactions', function (Blueprint $table) {
             $table->id();
             $table->unsignedBigInteger('product_id'); // ID produk
             $table->enum('transaction_type', ['in', 'out']); // Jenis transaksi (in/out)
             $table->integer('quantity'); // Jumlah barang yang masuk atau keluar
             $table->timestamp('transaction_date'); // Tanggal dan waktu transaksi
             $table->text('description')->nullable(); // Deskripsi tambahan (opsional)
             $table->timestamps(); // Tanggal dan waktu dibuat dan diperbarui
 
             // Menambahkan foreign key constraint
             $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
         });
     }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
};
