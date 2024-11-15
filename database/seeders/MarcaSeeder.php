<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Marca;
use Illuminate\Support\Facades\DB;

class MarcaSeeder extends Seeder
{
    public function run()
    {
        $marcas = ['Toyota', 'Ford', 'Chevrolet', 'Honda', 'BMW', 'Audi', 'Mercedes-Benz', 'Nissan', 'Hyundai', 'Mazda'];

        foreach ($marcas as $marca) {
            // Inserta el nombre de la marca directamente en la tabla usando DB
            DB::table('marca')->insert([
                'nombre' => $marca,
            ]);
        }
    }
}
