<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PolizaSeeder extends Seeder
{
    public function run()
    {
        DB::table('poliza')->insert([
            [
                'numero_poliza' => 'POL-2024-001',
                'vehiculo_id' => 1,
                'fecha_inicio' => '2024-01-01',
                'fecha_fin' => '2024-12-31',
                'monto_total' => 12000.00,
                'prima_mensual' => 1000.00,
                'estado' => 'activo',
                'documento_url' => 'polizas/pol-2024-001.pdf',
                'usuario_registro_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'numero_poliza' => 'POL-2024-002',
                'vehiculo_id' => 2,
                'fecha_inicio' => '2024-02-01',
                'fecha_fin' => '2025-01-31',
                'monto_total' => 15000.00,
                'prima_mensual' => 1250.00,
                'estado' => 'activo',
                'documento_url' => 'polizas/pol-2024-002.pdf',
                'usuario_registro_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}