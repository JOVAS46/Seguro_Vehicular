<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class ComprobantePagoSeeder extends Seeder
{
    public function run()
    {
        DB::table('comprobante_pago')->insert([
            [
                'pago_id' => 1,
                'numero_comprobante' => 'COMP-2024-001',
                'fecha_emision' => '2024-01-01',
                'monto_total' => 1000.00,
                'detalles_json' => json_encode([
                    'concepto' => 'Pago de cuota 1',
                    'metodo_pago' => 'Efectivo'
                ]),
                'estado' => 'emitido',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'pago_id' => 2,
                'numero_comprobante' => 'COMP-2024-002',
                'fecha_emision' => '2024-02-01',
                'monto_total' => 1000.00,
                'detalles_json' => json_encode([
                    'concepto' => 'Pago de cuota 2',
                    'metodo_pago' => 'Tarjeta de Crédito'
                ]),
                'estado' => 'emitido',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}