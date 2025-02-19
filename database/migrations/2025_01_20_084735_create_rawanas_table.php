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
        Schema::create('rawanas', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->string('eway_bill_no')->unique();
            $table->unsignedBigInteger('vendor_id')->nullable();
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->unsignedBigInteger('vehicle_id')->nullable();
            $table->decimal('vehicle_rate', 10, 2)->nullable();
            $table->decimal('rawana_weight', 15, 5)->nullable();
            $table->decimal('kanta_weight', 15, 5)->nullable();
            $table->enum('status', ['PENDING', 'PURCHASED', 'SALE'])->default('pending');
            $table->timestamps();

            $table->foreign('vendor_id')->references('id')->on('vendors')->onDelete('set null');
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('set null');
            $table->foreign('vehicle_id')->references('id')->on('vehicles')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rawanas');
    }
};
