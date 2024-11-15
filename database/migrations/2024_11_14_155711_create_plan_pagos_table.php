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
        Schema::create('plan_pago', function (Blueprint $table) {
            $table->id();
            $table->foreignId('poliza_id')->constrained('poliza');
            $table->decimal('monto_total', 10, 2);
            $table->date('fecha_inicio');
            $table->date('fecha_fin');
            $table->decimal('saldo', 10, 2);
            $table->string('tipo_plan');
            $table->integer('numero_cuotas');
            $table->string('estado');
            $table->foreignId('usuario_registro_id')->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plan_pagos');
    }
};
