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
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('rawana_id')->nullable();
            $table->date('date');
            $table->decimal('rawana_weight', 15, 5)->nullable();
            $table->decimal('kanta_weight', 15, 5)->nullable();
            $table->decimal('rate', 10, 2)->nullable();
            $table->decimal('total', 10, 2)->nullable();
            $table->unsignedBigInteger('vendor_id')->nullable();
            $table->unsignedBigInteger('vehicle_id')->nullable();
            $table->text('remark')->nullable();
            $table->string('photo')->nullable();
            $table->timestamps();

            $table->foreign('rawana_id')->references('id')->on('rawanas')->onDelete('set null');
            $table->foreign('vendor_id')->references('id')->on('vendors')->onDelete('set null');
            $table->foreign('vehicle_id')->references('id')->on('vehicles')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchases');
    }
};
