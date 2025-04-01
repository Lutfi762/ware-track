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
    Schema::create('customers', function (Blueprint $table) {
        $table->id();
        $table->string('pic');
        $table->enum('shift', ['1', '2']); // Menambahkan kolom untuk pilihan shift (1 atau 2)
        $table->enum('department', ['quality', 'production', 'maintenance', 'hr', 'warehouse', 'ga', 'hse' ]); // Menambahkan kolom untuk departemen dengan pilihan
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
    }
};
