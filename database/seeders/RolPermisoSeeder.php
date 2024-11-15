<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolPermisoSeeder extends Seeder
{
    public function run()
    {
        // Definimos 10 asociaciones entre roles y permisos
        for ($i = 1; $i <= 10; $i++) {
            DB::table('rol_permiso')->insert([
                'permiso_id' => rand(1, 10),  // Asocia aleatoriamente permisos del 1 al 10
                'rol_id' => rand(1, 5),       // Asocia aleatoriamente roles del 1 al 5
            ]);
        }
    }
}
