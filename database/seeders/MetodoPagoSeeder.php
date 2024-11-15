<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MetodoPagoSeeder extends Seeder
{
    public function run()
    {
        DB::table('metodo_pago')->insert([
            [
                'nombre' => 'Efectivo',
                'descripcion' => 'Pago en efectivo',
                'estado' => 'activo',
                'configuracion_json' => json_encode(['requiere_comprobante' => true]),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'Tarjeta de Crédito',
                'descripcion' => 'Pago con tarjeta de crédito',
                'estado' => 'activo',
                'configuracion_json' => json_encode(['tipos' => ['visa', 'mastercard']]),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'Transferencia Bancaria',
                'descripcion' => 'Transferencia entre cuentas',
                'estado' => 'activo',
                'configuracion_json' => json_encode(['requiere_comprobante' => true]),
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}