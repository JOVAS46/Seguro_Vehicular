<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoIncidenteSeeder extends Seeder
{
   public function run()
   {
       DB::table('tipo_incidente')->insert([
           [
               'nombre' => 'Colisión',
               'descripcion' => 'Accidente que involucra colisión con otro vehículo',
               'estado' => 'activo',
               'created_at' => now(),
               'updated_at' => now()
           ],
           [
               'nombre' => 'Robo',
               'descripcion' => 'Robo total o parcial del vehículo',
               'estado' => 'activo',
               'created_at' => now(),
               'updated_at' => now()
           ],
           [
               'nombre' => 'Desastre Natural',
               'descripcion' => 'Daños causados por eventos naturales',
               'estado' => 'activo',
               'created_at' => now(),
               'updated_at' => now()
           ],
           [
               'nombre' => 'Vandalismo',
               'descripcion' => 'Daños intencionales al vehículo',
               'estado' => 'activo',
               'created_at' => now(),
               'updated_at' => now()
           ],
           [
               'nombre' => 'Incendio',
               'descripcion' => 'Daños causados por fuego',
               'estado' => 'activo',
               'created_at' => now(),
               'updated_at' => now()
           ]
       ]);
   }
}