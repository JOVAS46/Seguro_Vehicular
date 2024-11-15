<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MotivoPagoSeeder extends Seeder
{
    public function run()
    {
        DB::table('motivo_pago')->insert([
            [
                'descripcion' => 'Pago de cuota mensual',
                'estado' => 'activo',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'descripcion' => 'Pago de prima inicial',
                'estado' => 'activo',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'descripcion' => 'Pago de deducible',
                'estado' => 'activo',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}