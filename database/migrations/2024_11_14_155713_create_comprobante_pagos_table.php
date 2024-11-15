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
        Schema::create('comprobante_pago', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pago_id')->constrained('pago');
            $table->string('numero_comprobante')->nullable();
            $table->timestamp('fecha_emision');
            $table->decimal('monto_total', 10, 2);
            $table->json('detalles_json')->nullable();
            $table->string('estado');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comprobante_pagos');
    }
};
