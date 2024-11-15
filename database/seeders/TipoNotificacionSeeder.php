<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoNotificacionSeeder extends Seeder
{
    public function run()
    {
        $tipos = ['Recordatorio de cita', 'Confirmación de registro', 'Aviso de vencimiento de póliza', 'Actualización de estado', 'Notificación general'];
        foreach ($tipos as $tipo) {
            // Usar DB para insertar directamente en la tabla 'tipo_notificaciones'
            DB::table('tipo_notificacion')->insert([
                'nombre' => $tipo,
                'descripcion' => 'Descripción para ' . $tipo,
            ]);
        }
    }
}
