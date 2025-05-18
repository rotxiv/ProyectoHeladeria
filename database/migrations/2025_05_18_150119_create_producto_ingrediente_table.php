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
        Schema::create('producto_ingrediente', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('producto_id');
            $table->unsignedBigInteger('ingrediente_id');
            $table->decimal('cantidad', 8, 2);
            $table->unsignedBigInteger('unidad_id');
            $table->timestamps();

            $table->foreign('unidad_id')->references('id')->on('unidades');
            $table->foreign('producto_id')->references('id')->on('productos');
            $table->foreign('ingrediente_id')->references('id')->on('ingredientes');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('producto_ingrediente');
    }
};
