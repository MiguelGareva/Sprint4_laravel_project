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
        Schema::create('combates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('entrenador1_id')->constrained('entrenadores');
            $table->foreignId('entrenador2_id')->constrained('entrenadores');
            $table->dateTime('fecha');
            $table->string('resultado');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('combates');
    }
};
