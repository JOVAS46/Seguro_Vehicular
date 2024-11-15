<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class IncidenteSeeder extends Seeder
{
    public function run()
    {
        DB::table('incidente')->insert([
            [
                'poliza_id' => 1,
                'fecha_incidente' => '2024-02-15 14:30:00',
                'descripcion' => 'Colisión lateral en intersección',
                'ubicacion' => 'Av. Principal y Calle 5',
                'monto_estimado' => 5000.00,
                'estado' => 'en_proceso',
                'cobertura_id' => 1,
                'usuario_registro_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'poliza_id' => 2,
                'fecha_incidente' => '2024-03-01 09:15:00',
                'descripcion' => 'Daño por granizo',
                'ubicacion' => 'Estacionamiento principal',
                'monto_estimado' => 3000.00,
                'estado' => 'reportado',
                'cobertura_id' => 1,
                'usuario_registro_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}