<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NotificacionSeeder extends Seeder
{
    public function run()
    {
        for ($i = 1; $i <= 10; $i++) {
            // Usar DB para insertar directamente en la tabla 'notificaciones'
            DB::table('notificacion')->insert([
                'mensaje' => 'Mensaje de notificación ' . $i,
                'fechaEnvio' => now()->addDays($i),
                'fechaCreacion' => now(),
                'estado' => 'enviado',
                'tipo_id' => rand(1, 5),
                'usuario_id' => rand(1, 10),
            ]);
        }
    }
}
