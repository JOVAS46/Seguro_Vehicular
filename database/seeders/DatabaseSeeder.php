<?php

namespace Database\Seeders;

use App\Models\TipoUsuario;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        $this->call([
            // Seeders para entidades sin dependencias
            PaisSeeder::class,               // Seeder para países
            CiudadSeeder::class,             // Seeder para ciudades

            // Seeders relacionados con roles y permisos
            RolSeeder::class,                // Seeder para roles
            PermisoSeeder::class,            // Seeder para permisos
            RolPermisoSeeder::class,         // Seeder para rol_permiso
            TipoUsuarioSeeder::class,

            // Seeders para usuarios y otros datos generales
            UsuarioSeeder::class,            // Seeder para usuarios
            MarcaSeeder::class,              // Seeder para marcas
            ModeloVehiculoSeeder::class,     // Seeder para modelos de vehículos
            TipoVehiculoSeeder::class,       // Seeder para tipos de vehículos
            VehiculoSeeder::class,           // Seeder para vehículos

            // Seeders para citas y notificaciones
            TipoNotificacionSeeder::class,   // Seeder para tipos de notificaciones

            NotificacionSeeder::class,       // Seeder para notificaciones
            TipoCitaSeeder::class,           // Seeder para tipos de citas
            CitaSeeder::class,               // Seeder para citas

            // Seeders para datos de bitácora y financieros
            BitacoraSeeder::class,           // Seeder para bitácoras
            ValorComercialSeeder::class,     // Seeder para valores comerciales
            DepreciacionSeeder::class,       // Seeder para depreciaciones

            // Nuevos seeders del sistema de pagos y pólizas (en orden de dependencia)
            MetodoPagoSeeder::class,
            MotivoPagoSeeder::class,
            CoberturaSeeder::class,
            PolizaSeeder::class,
            PolizaCoberturaSeeder::class,
            PlanPagoSeeder::class,
            CuotaSeeder::class,
            PagoSeeder::class,
            ComprobantePagoSeeder::class,
            TipoIncidenteSeeder::class,
        IncidenteSeeder::class,
        
            

            // Seeder de usuarios administrativos (puedes renombrar según el caso)
            UserSeeder::class,               // Seeder para usuarios (usuario de la aplicación)
        ]);
    }
}
