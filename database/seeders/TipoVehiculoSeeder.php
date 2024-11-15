<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoVehiculoSeeder extends Seeder
{
    /**
     * Ejecuta los seeders.
     *
     * @return void
     */
    public function run()
    {
        // Definimos algunos tipos de vehículos que deseamos insertar
        $tiposVehiculo = ['Sedán', 'SUV', 'Camioneta', 'Hatchback', 'Convertible'];

        foreach ($tiposVehiculo as $tipo) {
            DB::table('tipo_vehiculo')->insert([
                'nombre' => $tipo,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
