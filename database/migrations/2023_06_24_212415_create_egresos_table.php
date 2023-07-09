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
            $table->string('descripcion');
            $table->unsignedBigInteger('persona_id');
            $table->foreign('persona_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('categoria_egreso_id');
            $table->foreign('categoria_egreso_id')->references('id')->on('categoria_egresos')->onDelete('cascade');

            
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
