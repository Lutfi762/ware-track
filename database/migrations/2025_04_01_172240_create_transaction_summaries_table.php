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
        Schema::create('inventory_movements', function (Blueprint $table) {
            $table->id(); // ID unik untuk setiap entri
            $table->bigInteger('total_in')->default(0); // Total jumlah barang yang masuk
            $table->bigInteger('total_out')->default(0); // Total jumlah barang yang keluar
            $table->bigInteger('net_balance')->default(0); // Selisih antara total_in dan total_out
            $table->timestamps(); // Tanggal dan waktu dibuat dan diperbarui
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaction_summaries');
    }
};
