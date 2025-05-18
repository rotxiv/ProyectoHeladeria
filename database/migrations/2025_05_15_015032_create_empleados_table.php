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
        Schema::create('empleados', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('persona_id')->unique(); // Relación con Persona
            $table->string('direccion');
            $table->boolean('visible')->default(true);
            $table->timestamps();

            $table->foreign('persona_id')->references('id')->on('personas');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('empleados');
    }
};
