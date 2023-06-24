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
        Schema::create('egresos', function (Blueprint $table) {
            $table->id();
            $table->double('valor');
            $table->date('fecha');
            $table->string('nombre');
            $table->unsignedBigInteger('categoria_egreso_id');
            $table->unsignedBigInteger('sub_categoria_egreso_id');
            $table->unsignedBigInteger('historico_id');
            $table->unsignedBigInteger('alerta_id');

            $table->foreign('categoria_egresos_id')->references('id')->on('categoria_egresos')->onDelete('cascade');
            $table->foreign('subcategoria_egresos_id')->references('id')->on('categoria_egresos')->onDelete('cascade');
            $table->foreign('historico_id')->references('id')->on('categoria_ingresos')->onDelete('cascade');
            $table->foreign('alerta_id')->references('id')->on('alertas')->onDelete('cascade');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('egresos');
    }
};
