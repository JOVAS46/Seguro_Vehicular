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
        Schema::create('valor_comercial', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('vehiculo_id'); // Relación con el vehículo
            $table->decimal('valor_inicial', 10, 2);
            $table->decimal('valor_actual', 10, 2);
            $table->date('fecha_valor');
            $table->decimal('tasa_depreciacion', 5, 2); // Depreciación en porcentaje
            $table->integer('anos_depreciacion');

            // Definición de clave foránea
            $table->foreign('vehiculo_id')->references('id')->on('vehiculo')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('valor_comercial');
    }
};
