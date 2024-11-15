<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ModeloVehiculoSeeder extends Seeder
{
    public function run()
    {
        $modelos = ['Corolla', 'Mustang', 'Civic', 'A4', '320i', 'Camry', 'Accord', 'Altima', 'Elantra', 'CX-5'];
        
        foreach ($modelos as $modelo) {
            // Usar DB para insertar directamente en la tabla 'modelo_vehiculos'
            DB::table('modelo_vehiculo')->insert([
                'nombre' => $modelo,
            ]);
        }
    }
}
