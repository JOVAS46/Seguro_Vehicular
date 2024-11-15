<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepreciacionSeeder extends Seeder
{
    public function run()
    {
        for ($i = 1; $i <= 10; $i++) {
            DB::table('depreciacion')->insert([
                'valor_comercial_id' => rand(1, 10),  // Asociamos aleatoriamente un valor_comercial_id de 1 a 10
                'valor_inicial' => rand(5000, 20000),  // Valor inicial aleatorio
                'valor_depreciado' => rand(1000, 4000),  // Valor depreciado aleatorio
                'fecha_depreciacion' => now()->subMonths($i),  // Fecha de depreciación, con meses hacia atrás
                'motivo_depreciacion' => 'Motivo de depreciación ' . $i,  // Motivo de la depreciación
                'created_at' => now(),  // Timestamps si es necesario
                'updated_at' => now(),
            ]);
        }
    }
}
