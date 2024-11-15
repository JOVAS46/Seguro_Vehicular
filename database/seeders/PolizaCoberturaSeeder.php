<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PolizaCoberturaSeeder extends Seeder
{
    public function run()
    {
        DB::table('poliza_cobertura')->insert([
            [
                'poliza_id' => 1,
                'cobertura_id' => 1,
                'monto_cobertura' => 50000.00,
                'estado' => 'activo',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'poliza_id' => 1,
                'cobertura_id' => 2,
                'monto_cobertura' => 25000.00,
                'estado' => 'activo',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'poliza_id' => 2,
                'cobertura_id' => 1,
                'monto_cobertura' => 35000.00,
                'estado' => 'activo',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}