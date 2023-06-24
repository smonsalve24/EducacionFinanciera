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
        Schema::create('categoria_egresos', function (Blueprint $table) {
            $table->id();
            $table->string('tipo_egreso');
            $table->string('nombre');
            // $table->unsignedBigInteger('egreso_id');
            $table->unsignedBigInteger('sub_categoria_id');

            $table->foreign('egreso_id')->references('id')->on('egresos')->onDelete('cascade');
            // $table->foreign('sub_categoria_id')->references('id')->on('sub_categoria_egresos')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categoria_egresos');
    }
};
