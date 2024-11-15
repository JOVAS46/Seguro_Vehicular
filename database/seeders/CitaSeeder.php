<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CitaSeeder extends Seeder
{
    public function run()
    {
        for ($i = 1; $i <= 10; $i++) {
            // Usar DB para insertar directamente en la tabla 'citas'
            DB::table('cita')->insert([
                'fecha' => now()->addDays($i),
                'duracion' => rand(30, 120), // Duración en minutos
                'motivo' => 'Motivo ' . $i,
                'estado' => 'pendiente',
                'fechaCreacion' => now(),
                'solicitante_id' => rand(1, 10),
                'recepcion_id' => rand(1, 5),
                'tipoCita_id' => rand(1, 5),
            ]);
        }
    }
}
