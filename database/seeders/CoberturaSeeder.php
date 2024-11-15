<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CoberturaSeeder extends Seeder
{
    public function run()
    {
        DB::table('cobertura')->insert([
            [
                'nombre' => 'Cobertura Total',
                'descripcion' => 'Cubre daños al vehículo y a terceros',
                'monto_maximo' => 50000.00,
                'estado' => 'activo',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'Responsabilidad Civil',
                'descripcion' => 'Cubre daños a terceros',
                'monto_maximo' => 25000.00,
                'estado' => 'activo',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'Robo Total',
                'descripcion' => 'Cubre robo del vehículo',
                'monto_maximo' => 35000.00,
                'estado' => 'activo',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}