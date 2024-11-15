<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ValorComercialSeeder extends Seeder
{
    public function run()
    {
        for ($i = 1; $i <= 10; $i++) {
            DB::table('valor_comercial')->insert([
                'vehiculo_id' => rand(1, 10),  // Asocia aleatoriamente un vehículo de 1 a 10
                'valor_inicial' => rand(10000, 50000),  // Valor inicial aleatorio
                'valor_actual' => rand(5000, 45000),  // Valor actual aleatorio
                'fecha_valor' => now()->subDays(rand(1, 365)),  // Fecha aleatoria del último año
                'tasa_depreciacion' => rand(5, 20),  // Tasa de depreciación en porcentaje
                'anos_depreciacion' => rand(1, 10),  // Años de depreciación
                'created_at' => now(),  // Timestamps si es necesario
                'updated_at' => now(),
            ]);
        }
    }
}
