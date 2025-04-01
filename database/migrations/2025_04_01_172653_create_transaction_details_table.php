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
        Schema::create('transaction_details', function (Blueprint $table) {
            $table->id(); // ID unik untuk setiap detail transaksi
            $table->unsignedBigInteger('transaction_id'); // ID transaksi
            $table->unsignedBigInteger('product_id'); // ID produk
            $table->integer('qty'); // Jumlah produk
            $table->timestamps(); // Tanggal dan waktu dibuat dan diperbarui

            // Relationship with transactions
            $table->foreign('transaction_id')->references('id')->on('transactions')->onDelete('cascade');

            // Relationship with products
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
        Schema::dropIfExists('transaction_details');
    }
};
