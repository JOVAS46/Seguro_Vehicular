<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CuotaSeeder extends Seeder
{
    public function run()
    {
        // Para el primer plan de pago
        for($i = 1; $i <= 12; $i++) {
            DB::table('cuota')->insert([
                'plan_pago_id' => 1,
                'numero_cuota' => $i,
                'monto_cuota' => 1000.00,
                'estado_cuota' => $i <= 2 ? 'pagado' : 'pendiente',
                'fecha_vencimiento' => date('Y-m-d', strtotime('2024-01-01 +'.($i-1).' months')),
                'fecha_pago' => $i <= 2 ? date('Y-m-d', strtotime('2024-01-01 +'.($i-1).' months')) : null,
                'estado' => 'activo',
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }

        // Para el segundo plan de pago
        for($i = 1; $i <= 12; $i++) {
            DB::table('cuota')->insert([
                'plan_pago_id' => 2,
                'numero_cuota' => $i,
                'monto_cuota' => 1250.00,
                'estado_cuota' => $i == 1 ? 'pagado' : 'pendiente',
                'fecha_vencimiento' => date('Y-m-d', strtotime('2024-02-01 +'.($i-1).' months')),
                'fecha_pago' => $i == 1 ? '2024-02-01' : null,
                'estado' => 'activo',
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}