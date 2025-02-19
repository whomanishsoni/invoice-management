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
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('rawana_id');
            $table->date('date');
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('vendor_id');
            $table->decimal('rawana_weight', 15, 5)->nullable();
            $table->decimal('kanta_weight', 15, 5)->nullable();
            $table->decimal('rate', 10, 2);
            $table->decimal('total', 10, 2);
            $table->unsignedBigInteger('vehicle_id');
            $table->enum('reverse_charges', ['Y', 'N'])->nullable();
            $table->string('transport_name')->nullable();
            $table->date('date_of_supply')->nullable();
            $table->string('place_of_supply')->nullable();
            $table->string('remark')->nullable();
            $table->string('photo')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
