<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BitacoraSeeder extends Seeder
{
    public function run()
    {
        for ($i = 1; $i <= 10; $i++) {
            // Usar DB para insertar directamente en la tabla 'bitacoras'
            DB::table('bitacora')->insert([
                'usuario_id' => rand(1, 10),
                'fechaHora' => now(),
                'accion' => 'Acción ' . $i,
                'detalles' => 'Detalle de la acción ' . $i,
                'ip' => '192.168.0.' . rand(1, 100),
            ]);
        }
    }
}
