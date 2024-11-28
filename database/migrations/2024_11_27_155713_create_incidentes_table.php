<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('incidente', function (Blueprint $table) {
            $table->id();
            $table->foreignId('poliza_id')->constrained('poliza');
            $table->foreignId('tipo_incidente_id')->constrained('tipo_incidente');
            $table->timestamp('fecha_incidente');
            $table->text('descripcion');
            $table->string('ubicacion')->nullable();
            $table->decimal('monto_estimado', 10, 2)->nullable();
            $table->string('estado');
            $table->foreignId('cobertura_id')->constrained('cobertura');
            $table->foreignId('usuario_registro_id')->constrained('users');
            // Nuevos campos
            $table->string('maps_url')->nullable();
            $table->string('imagen_1')->nullable();
            $table->string('imagen_2')->nullable();
            $table->string('imagen_3')->nullable();
            $table->string('imagen_4')->nullable();
            $table->text('descripcion_imagen')->nullable();
            $table->date('fecha_reporte')->nullable();
            $table->string('estado_reporte')->nullable();
            $table->string('url_imagen')->nullable();
            $table->string('oficial_cargo')->nullable();
            $table->text('observacion')->nullable();
            $table->timestamps();
        });
    }
    
    
};
