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
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('persona_id')->unique(); // Relación con Persona
            $table->string('codigo')->unique(); // Código único para cada cliente
            $table->boolean('visible')->default(true); // Cliente activo por defecto
            $table->timestamps();

            // Clave foránea que relaciona Cliente con Persona
            $table->foreign('persona_id')->references('id')->on('personas');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clientes');
    }
};
