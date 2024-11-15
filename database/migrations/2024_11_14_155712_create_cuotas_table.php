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
        Schema::create('cuota', function (Blueprint $table) {
            $table->id();
            $table->foreignId('plan_pago_id')->constrained('plan_pago');
            $table->integer('numero_cuota');
            $table->decimal('monto_cuota', 10, 2);
            $table->string('estado_cuota');
            $table->date('fecha_vencimiento');
            $table->date('fecha_pago')->nullable();
            $table->string('estado');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cuotas');
    }
};
