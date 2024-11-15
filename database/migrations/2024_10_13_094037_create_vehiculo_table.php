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
        Schema::create('vehiculo', function (Blueprint $table) {
            $table->id();
            $table->integer('anio');
            $table->string('placa', 20);
            $table->integer('kilometraje');
            $table->date('fecha_adquisicion');
            $table->string('url_imagen')->nullable();
            $table->string('url_documento')->nullable();
            $table->unsignedBigInteger('marca_id');
            $table->unsignedBigInteger('modelo_id');
            $table->unsignedBigInteger('tipoVehiculo_id');
            $table->unsignedBigInteger('propietario_id');

            // Definición de claves foráneas
            $table->foreign('marca_id')->references('id')->on('marca')->onDelete('cascade');
            $table->foreign('modelo_id')->references('id')->on('modelo_vehiculo')->onDelete('cascade');
            $table->foreign('tipoVehiculo_id')->references('id')->on('tipo_vehiculo')->onDelete('cascade');
            $table->foreign('propietario_id')->references('id')->on('usuario')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehiculo');
    }
};
