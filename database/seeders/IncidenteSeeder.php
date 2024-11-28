<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IncidenteSeeder extends Seeder
{
    public function run()
    {
        DB::table('incidente')->insert([
            [
                'poliza_id' => 1,
                'tipo_incidente_id' => 1,
                'fecha_incidente' => '2024-02-15 14:30:00',
                'descripcion' => 'Colisión lateral en intersección',
                'ubicacion' => 'Av. Principal y Calle 5',
                'monto_estimado' => 5000.00,
                'estado' => 'en_proceso',
                'cobertura_id' => 1,
                'usuario_registro_id' => 1,
                'maps_url' => 'https://goo.gl/maps/ejemplo1',
                'imagen_1' => 'incidentes/caso1_foto1.jpg',
                'imagen_2' => 'incidentes/caso1_foto2.jpg',
                'imagen_3' => 'incidentes/caso1_foto3.jpg',
                'imagen_4' => 'incidentes/caso1_foto4.jpg',
                'descripcion_imagen' => 'Fotos del daño lateral y frontal del vehículo',
                'fecha_reporte' => '2024-02-15',
                'estado_reporte' => 'completado',
                'url_imagen' => 'reportes/reporte1.pdf',
                'oficial_cargo' => 'Oficial Juan Pérez',
                'observacion' => 'Daños considerables en la parte lateral',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'poliza_id' => 2,
                'tipo_incidente_id' => 2,
                'fecha_incidente' => '2024-03-01 09:15:00',
                'descripcion' => 'Daño por granizo',
                'ubicacion' => 'Estacionamiento principal',
                'monto_estimado' => 3000.00,
                'estado' => 'reportado',
                'cobertura_id' => 1,
                'usuario_registro_id' => 1,
                'maps_url' => 'https://goo.gl/maps/ejemplo2',
                'imagen_1' => 'incidentes/caso2_foto1.jpg',
                'imagen_2' => 'incidentes/caso2_foto2.jpg',
                'imagen_3' => null,
                'imagen_4' => null,
                'descripcion_imagen' => 'Fotos del daño en el techo y capó',
                'fecha_reporte' => '2024-03-01',
                'estado_reporte' => 'en_proceso',
                'url_imagen' => null,
                'oficial_cargo' => 'Oficial María García',
                'observacion' => 'Múltiples abolladuras por granizo',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}