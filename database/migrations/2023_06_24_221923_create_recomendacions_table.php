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
        Schema::create('recomendacions', function (Blueprint $table) {
            $table->id();
            $table->string('correo_usuario');
            $table->longText('mensaje');
            $table->string('recomendacion');
            $table->unsignedBigInteger('persona_id');
            $table->foreign('persona_id')->references('id')->on('users')->onDelete('cascade');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recomendacions');
    }
};
