<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CiudadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('ciudad')->insert([
            // Argentina
            [
                'nombre' => 'Buenos Aires',
                'pais_id' => 1, // ID de Argentina
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Córdoba',
                'pais_id' => 1, // ID de Argentina
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Rosario',
                'pais_id' => 1, // ID de Argentina
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Brasil
            [
                'nombre' => 'São Paulo',
                'pais_id' => 2, // ID de Brasil
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Río de Janeiro',
                'pais_id' => 2, // ID de Brasil
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Brasilia',
                'pais_id' => 2, // ID de Brasil
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Chile
            [
                'nombre' => 'Santiago',
                'pais_id' => 3, // ID de Chile
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Valparaíso',
                'pais_id' => 3, // ID de Chile
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Concepción',
                'pais_id' => 3, // ID de Chile
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Colombia
            [
                'nombre' => 'Bogotá',
                'pais_id' => 4, // ID de Colombia
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Medellín',
                'pais_id' => 4, // ID de Colombia
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Cali',
                'pais_id' => 4, // ID de Colombia
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // México
            [
                'nombre' => 'Ciudad de México',
                'pais_id' => 5, // ID de México
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Guadalajara',
                'pais_id' => 5, // ID de México
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Monterrey',
                'pais_id' => 5, // ID de México
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Otras ciudades para completar 20
            [
                'nombre' => 'Mendoza',
                'pais_id' => 1, // ID de Argentina
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Fortaleza',
                'pais_id' => 2, // ID de Brasil
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Viña del Mar',
                'pais_id' => 3, // ID de Chile
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Cartagena',
                'pais_id' => 4, // ID de Colombia
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Puebla',
                'pais_id' => 5, // ID de México
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
