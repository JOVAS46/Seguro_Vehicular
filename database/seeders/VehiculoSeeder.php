<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class VehiculoSeeder extends Seeder
{
    /**
     * Ejecuta los seeders.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        // Generamos 10 vehículos de ejemplo
        for ($i = 1; $i <= 10; $i++) {
            DB::table('vehiculo')->insert([
                'anio' => $faker->year,
                'placa' => strtoupper($faker->bothify('??-####')),  // Genera una placa con formato como 'AB-1234'
                'kilometraje' => $faker->numberBetween(1000, 200000),  // Kilometraje aleatorio
                'fecha_adquisicion' => $faker->date(),
                'url_imagen' => $faker->imageUrl(),  // URL de imagen aleatoria
                'url_documento' => $faker->url,  // URL de documento aleatoria
                'marca_id' => DB::table('marca')->inRandomOrder()->value('id'),  // Obtiene un id aleatorio de la tabla 'marca'
                'modelo_id' => DB::table('modelo_vehiculo')->inRandomOrder()->value('id'),  // Obtiene un id aleatorio de la tabla 'modelo_vehiculo'
                'tipoVehiculo_id' => DB::table('tipo_vehiculo')->inRandomOrder()->value('id'),  // Obtiene un id aleatorio de la tabla 'tipo_vehiculo'
                'propietario_id' => DB::table('usuario')->inRandomOrder()->value('id'),  // Obtiene un id aleatorio de la tabla 'usuario' (propietario)
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
