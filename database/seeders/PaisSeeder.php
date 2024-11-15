<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PaisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Insertar datos en la tabla 'pais'
        DB::table('pais')->insert([
            [
                'nombre' => 'Argentina',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Brasil',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Chile',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Colombia',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'México',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
