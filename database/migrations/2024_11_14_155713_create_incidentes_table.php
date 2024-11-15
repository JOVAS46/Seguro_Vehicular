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
        Schema::create('incidente', function (Blueprint $table) {
            $table->id();
            $table->foreignId('poliza_id')->constrained('poliza');
            $table->timestamp('fecha_incidente');
            $table->text('descripcion');
            $table->string('ubicacion')->nullable();
            $table->decimal('monto_estimado', 10, 2)->nullable();
            $table->string('estado');
            $table->foreignId('cobertura_id')->constrained('cobertura');
            $table->foreignId('usuario_registro_id')->constrained('users');
            $table->timestamps();
        });
    
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('incidentes');
    }
};
