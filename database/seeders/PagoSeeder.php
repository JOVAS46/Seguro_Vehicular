<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PagoSeeder extends Seeder
{
    public function run()
    {
        DB::table('pago')->insert([
            [
                'cuota_id' => 1,
                'metodo_pago_id' => 1,
                'motivo_pago_id' => 1,
                'usuario_registro_id' => 1,
                'fecha' => '2024-01-01',
                'monto' => 1000.00,
                'notas' => 'Primer pago',
                'estado' => 'completado',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'cuota_id' => 2,
                'metodo_pago_id' => 2,
                'motivo_pago_id' => 1,
                'usuario_registro_id' => 1,
                'fecha' => '2024-02-01',
                'monto' => 1000.00,
                'notas' => 'Segundo pago',
                'estado' => 'completado',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}