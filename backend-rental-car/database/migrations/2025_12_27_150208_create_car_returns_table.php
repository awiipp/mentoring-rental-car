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
        Schema::create('car_returns', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_tenant')->references('id')->on('registers')->onDelete('cascade');
            $table->foreignId('id_car')->references('id')->on('cars')->onDelete('cascade');
            $table->foreignId('id_penalties')->references('id')->on('penalties')->onDelete('cascade');
            $table->date('date_borrow');
            $table->date('date_return');
            $table->integer('penalties_total');
            $table->integer('discount');
            $table->integer('total');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('car_returns');
    }
};
