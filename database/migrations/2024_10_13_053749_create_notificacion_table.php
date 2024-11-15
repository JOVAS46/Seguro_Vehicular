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
        Schema::create('notificacion', function (Blueprint $table) {
            $table->id();
            $table->string('mensaje', 255);
            
            // Permitir NULL en FechaEnvio y FechaCreacion
            $table->date('fechaEnvio')->nullable();
            $table->date('fechaCreacion')->nullable();
            
            // Permitir NULL en  Estado
            $table->string('estado', 20)->nullable();
            // Claves foráneas
            $table->unsignedBigInteger('tipo_id');
            $table->unsignedBigInteger('usuario_id');
            $table->foreign('usuario_id')->references('id')->on('usuario')->onDelete('restrict');
            $table->foreign('tipo_id')->references('id')->on('tipo_notificacion')->onDelete('restrict');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notificacion');
    }
};
