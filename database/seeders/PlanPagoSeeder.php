<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlanPagoSeeder extends Seeder
{
    public function run()
    {
        DB::table('plan_pago')->insert([
            [
                'poliza_id' => 1,
                'monto_total' => 12000.00,
                'fecha_inicio' => '2024-01-01',
                'fecha_fin' => '2024-12-31',
                'saldo' => 12000.00,
                'tipo_plan' => 'Mensual',
                'numero_cuotas' => 12,
                'estado' => 'activo',
                'usuario_registro_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'poliza_id' => 2,
                'monto_total' => 15000.00,
                'fecha_inicio' => '2024-02-01',
                'fecha_fin' => '2025-01-31',
                'saldo' => 15000.00,
                'tipo_plan' => 'Mensual',
                'numero_cuotas' => 12,
                'estado' => 'activo',
                'usuario_registro_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}