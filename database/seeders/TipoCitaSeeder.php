<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoCitaSeeder extends Seeder
{
    public function run()
    {
        $tipos = ['Inspección', 'Revisión', 'Asesoría', 'Renovación de seguro', 'Evaluación de siniestro'];
        foreach ($tipos as $tipo) {
            // Usar DB para insertar directamente en la tabla 'tipo_citas'
            DB::table('tipo_cita')->insert([
                'nombre' => $tipo,
                'descripcion' => 'Descripción para ' . $tipo,
            ]);
        }
    }
}
