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
        Schema::create('categoria_ingresos', function (Blueprint $table) {
            $table->id();
            $table->string('tipo_ingreso');
            $table->string('nombre');
            // $table->unsignedBigInteger('ingreso_id');
            // $table->foreign('ingreso_id')->references('id')->on('ingresos')->onDelete('cascade');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categoria_ingresos');
    }
};
