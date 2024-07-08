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
        Schema::create('vehicle_parked', function (Blueprint $table) {
            $table->id();
            $table->string('operator_id');
            $table->string('vehicle_id');
            $table->string('vehicle_number');
            $table->string('date');
            $table->string('time');
            $table->string('status');
            $table->foreign('operator_id')->references('id')->on('user')->cascadeOnDelete();
            $table->foreign('vehicle_id')->references('id')->on('vehicle')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicle_parked');
    }
};
