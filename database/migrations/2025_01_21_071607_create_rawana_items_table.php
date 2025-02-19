<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('rawana_items', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->unsignedBigInteger('rawana_id');
            $table->unsignedBigInteger('product_id');
            $table->string('product_name');
            $table->string('hsn_code')->nullable();
            $table->string('grade')->nullable();
            $table->decimal('tax_rate', 5, 2)->default(0.00);
            $table->decimal('purchase_price', 10, 2)->default(0.00);
            $table->decimal('sale_price', 10, 2)->default(0.00);
            $table->decimal('tax_amount', 10, 2)->default(0.00);
            $table->timestamps();

            $table->foreign('rawana_id')->references('id')->on('rawanas')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rawana_items');
    }
};
