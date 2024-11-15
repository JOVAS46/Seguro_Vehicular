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
        Schema::create('poliza_cobertura', function (Blueprint $table) {
            $table->id();
            $table->foreignId('poliza_id')->constrained('poliza');
            $table->foreignId('cobertura_id')->constrained('cobertura');
            $table->decimal('monto_cobertura', 10, 2);
            $table->string('estado');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('poliza_coberturas');
    }
};
