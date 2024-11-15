<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermisoSeeder extends Seeder
{
    public function run()
    {
        $permisos = ['Crear usuario', 'Editar usuario', 'Eliminar usuario', 'Ver reportes', 'Gestionar ventas', 'Crear citas', 'Cancelar citas', 'Editar vehiculos', 'Aprobar permisos', 'Acceder a la bitácora'];
        
        foreach ($permisos as $permiso) {
            DB::table('permisos')->insert([
                'Descripcion' => $permiso,
            ]);
        }
    }
}
