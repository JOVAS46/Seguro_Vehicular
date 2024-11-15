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
        Schema::create('usuario', function (Blueprint $table) {
            $table->id(); // id del usuario
            $table->string('nombre'); // nombre del usuario
            $table->string('apellido'); // apellido del usuario
            $table->string('email')->unique(); // email, asegurando que sea único
            $table->string('contrasena')->nullable(); // contrasena (puede ser nula)
            $table->string('estado'); // estado del usuario
            $table->integer('ci')->nullable(); // cédula de identidad (puede ser nula)
            $table->integer('celular')->nullable(); // celular (puede ser nulo)
            $table->string('direccion')->nullable(); // dirección (puede ser nula)
            $table->unsignedBigInteger('tipoUsuario_id'); // tipo de usuario
            $table->unsignedBigInteger('rol_id'); // rol del usuario
            $table->unsignedBigInteger('pais_id')->nullable(); // país del usuario (puede ser nulo)
            $table->unsignedBigInteger('ciudad_id')->nullable(); // ciudad del usuario (puede ser nulo)
            $table->unsignedBigInteger('user_id')->nullable();  // Agrega el campo user_id
            // Relaciones de clave foránea
            $table->foreign('tipoUsuario_id')->references('id')->on('tipo_usuario')->onDelete('restrict'); 
            $table->foreign('rol_id')->references('id')->on('rol')->onDelete('restrict'); 
            $table->foreign('pais_id')->references('id')->on('pais')->onDelete('set null');
            $table->foreign('ciudad_id')->references('id')->on('ciudad')->onDelete('set null');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->timestamps(); // marcas de tiempo
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuario');
    }
};
