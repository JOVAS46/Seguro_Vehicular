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
        Schema::create('pago', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cuota_id')->constrained('cuota');
            $table->foreignId('metodo_pago_id')->constrained('metodo_pago');
            $table->foreignId('motivo_pago_id')->constrained('motivo_pago');
            $table->foreignId('usuario_registro_id')->constrained('users');
            $table->date('fecha');
            $table->decimal('monto', 10, 2);
            $table->text('notas')->nullable();
            $table->string('estado');
            $table->string('comprobante_pago')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pagos');
    }
};
