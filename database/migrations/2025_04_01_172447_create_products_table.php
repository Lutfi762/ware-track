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
    Schema::create('products', function (Blueprint $table) {
        $table->id();
        $table->string('name'); // Nama produk
        $table->string('image');
        $table->string('barcode')->unique();
        $table->text('description')->nullable(); // Deskripsi produk
        $table->string('sku')->unique(); // Kode unik untuk produk
        $table->integer('quantity'); // Jumlah produk di gudang
        $table->foreignId('category_id')->constrained()->onDelete('cascade'); // ID kategori
        $table->foreignId('supplier_id')->constrained()->onDelete('cascade'); // ID pemasok
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
        Schema::dropIfExists('products');
    }
};
