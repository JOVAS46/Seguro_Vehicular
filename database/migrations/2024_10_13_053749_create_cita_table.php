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
        Schema::create('cita', function (Blueprint $table) {
            $table->id();
            $table->dateTime('fecha');
            $table->integer('duracion');
            $table->string('motivo', 255)->nullable();
            $table->string('estado', 20);
            $table->dateTime('fechaCreacion');
            $table->unsignedBigInteger('solicitante_id');
            $table->unsignedBigInteger('recepcion_id');
            $table->unsignedBigInteger('tipoCita_id')->nullable();

            // Definición correcta de las claves foráneas
            $table->foreign('solicitante_id')->references('id')->on('usuario')->onDelete('restrict');
            $table->foreign('recepcion_id')->references('id')->on('usuario')->onDelete('restrict');

            $table->foreign('tipoCita_id')->references('id')->on('tipo_cita')->onDelete('set null');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cita');
    }
};
