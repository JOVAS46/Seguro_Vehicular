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
        Schema::create('bitacora', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('usuario_id'); // Relacionada con la tabla 'usuario'
            $table->timestamp('fechaHora')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->string('accion', 100);
            $table->text('detalles')->nullable();
            $table->string('ip', 15)->nullable();
            $table->timestamps(); // Incluye created_at y updated_at automáticamente
        
            // Clave foránea
            $table->foreign('usuario_id')->references('id')->on('usuario')->onDelete('cascade');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bitacora');
    }
};
