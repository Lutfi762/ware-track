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
            $table->id(); // Primary key
            $table->unsignedBigInteger('product_id'); // Foreign key for products
            $table->enum('transaction_type', ['in', 'out']); // Transaction type (in/out)
            $table->integer('quantity'); // Quantity of items
            $table->timestamp('transaction_date'); // Date and time of transaction
            $table->text('description')->nullable(); // Optional description
            $table->timestamps(); // Created and updated timestamps

            // Adding foreign key constraint
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
        Schema::dropIfExists('transactions'); // Drop the transactions table
    }
};