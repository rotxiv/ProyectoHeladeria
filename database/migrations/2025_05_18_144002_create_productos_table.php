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
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('item_id')->unique();
            $table->string('nombre');
            $table->unsignedBigInteger('tipo_id');
            $table->unsignedBigInteger('sabor_id');            
            $table->text('observacion');
            $table->boolean('visible')->default(true);
            $table->timestamps();

            $table->foreign('item_id')->references('id')->on('items');
            $table->foreign('tipo_id')->references('id')->on('tipos');
            $table->foreign('sabor_id')->references('id')->on('sabores');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
