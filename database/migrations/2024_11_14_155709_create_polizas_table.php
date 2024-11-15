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
        Schema::create('poliza', function (Blueprint $table) {
            $table->id();
            $table->string('numero_poliza')->unique();
            $table->foreignId('vehiculo_id')->constrained('vehiculo');
            $table->date('fecha_inicio');
            $table->date('fecha_fin');
            $table->decimal('monto_total', 10, 2);
            $table->decimal('prima_mensual', 10, 2);
            $table->string('estado');
            $table->string('documento_url')->nullable();
            $table->foreignId('usuario_registro_id')->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('polizas');
    }
};
