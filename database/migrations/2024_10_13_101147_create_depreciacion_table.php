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
        Schema::create('depreciacion', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('valor_comercial_id'); // Relación con valor_comercial
            $table->decimal('valor_inicial', 10, 2);
            $table->decimal('valor_depreciado', 10, 2);
            $table->date('fecha_depreciacion');
            $table->string('motivo_depreciacion', 255);

            // Definición de clave foránea
            $table->foreign('valor_comercial_id')->references('id')->on('valor_comercial')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('depreciacion');
    }
};
