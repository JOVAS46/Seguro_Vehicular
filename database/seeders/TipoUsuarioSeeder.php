<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoUsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Definimos los tipos de usuario que deseamos insertar
        $tipos = ['Cliente', 'Agente', 'Administrador', 'Supervisor', 'Recepcionista'];

        foreach ($tipos as $tipo) {
            DB::table('tipo_usuario')->insert([
                'nombre' => $tipo,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
