<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class UsuarioSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        
        for ($i = 1; $i <= 10; $i++) {
            // Usamos Faker para generar un nombre aleatorio
            $userName = $faker->name;
            // Generamos el email de forma aleatoria para ambas tablas
            $email = $faker->unique()->safeEmail;

            // Insertar en la tabla `users` para autenticación
            $userId = DB::table('users')->insertGetId([
                'name' => $userName,  // Nombre generado por Faker
                'email' => $email,  // Email generado por Faker
                'password' => Hash::make('password123'),  // Contraseña cifrada
            ]);

            // Insertar los datos extendidos en la tabla `usuario` usando el mismo nombre
            DB::table('usuario')->insert([
                'nombre' => $userName,  // Mismo nombre que en la tabla `users`
                'apellido' => $faker->lastName,  // Apellido generado por Faker
                'email' => $email,  // Mismo email generado por Faker
                'contrasena' => Hash::make('password123'),  // Contraseña cifrada
                'estado' => 'activo',
                'ci' => $faker->numberBetween(1000000, 9999999),  // Cédula aleatoria de 7 dígitos
                'celular' => $faker->numberBetween(600000000, 999999999),  // Números aleatorios para celular
                'direccion' => $faker->address,  // Dirección aleatoria
                'tipoUsuario_id' => DB::table('tipo_usuario')->inRandomOrder()->value('id'),  // ID aleatorio de tipo_usuario
                'rol_id' => DB::table('rol')->inRandomOrder()->value('id'),  // ID aleatorio de roles
                'pais_id' => $faker->numberBetween(1, 5),  // Pais_id entre 1 y 5
                'ciudad_id' => $faker->numberBetween(1, 20),  // Ciudad_id entre 1 y 20
                'user_id' => $userId,  // Relacionar con el ID del usuario creado en la tabla `users`
            ]);
        }
    }
}
