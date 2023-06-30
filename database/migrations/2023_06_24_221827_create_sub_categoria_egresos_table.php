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
        Schema::create('sub_categoria_egresos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            // $table->unsignedBigInteger('egreso_id');
            $table->unsignedBigInteger('categoria_egreso_id');

            // $table->foreign('egreso_id')->references('id')->on('egresos')->onDelete('cascade');
            $table->foreign('categoria_egreso_id')->references('id')->on('categoria_egresos')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sub_categoria_egresos');
    }
};
