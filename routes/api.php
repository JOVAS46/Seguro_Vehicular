<?php

use App\Http\Controllers\BitacoraController;
use App\Http\Controllers\CitaController;
use App\Http\Controllers\NotificacionController;
use App\Http\Controllers\PermisoController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\RolPermisoController;
use App\Http\Controllers\PaisController;
use App\Http\Controllers\CiudadController;
use App\Http\Controllers\TipoCitaController;
use App\Http\Controllers\TipoNotificacionController;
use App\Http\Controllers\TipoUsuarioController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\MarcaController;
use App\Http\Controllers\TipoVehiculoController;
use App\Http\Controllers\ModeloVehiculoController;
use App\Http\Controllers\VehiculoController;
use App\Http\Controllers\ValorComercialController;
use App\Http\Controllers\DepreciacionController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BackupController;
//////////////////////////////////////////////////
use App\Http\Controllers\MetodoPagoController;
use App\Http\Controllers\MotivoPagoController;
use App\Http\Controllers\PlanPagoController;
use App\Http\Controllers\CuotaController;
use App\Http\Controllers\PagoController;
use App\Http\Controllers\ComprobantePagoController;
use App\Http\Controllers\CoberturaController;
use App\Http\Controllers\PolizaController;
use App\Http\Controllers\PolizaCoberturaController;
use App\Http\Controllers\IncidenteController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');



//---------------------------------------------------------------
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/backup', [BackupController::class, 'runBackup']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);
    Route::apiResource('pais', PaisController::class);
    Route::apiResource('roles', RolController::class);
    Route::apiResource('permisos', PermisoController::class);
    Route::apiResource('rol_permiso', RolPermisoController::class);
    Route::apiResource('tipo_usuario', TipoUsuarioController::class);
    Route::apiResource('usuarios', UsuarioController::class);
    Route::apiResource('tipo_cita', TipoCitaController::class);
    Route::apiResource('citas', CitaController::class);
    Route::apiResource('bitacora', BitacoraController::class);
    Route::apiResource('tipo_notificacion', TipoNotificacionController::class);
    Route::apiResource('notificacion', NotificacionController::class);

    Route::apiResource('ciudad', CiudadController::class);
    Route::apiResource('marca', MarcaController::class);
    Route::apiResource('tipo_vehiculo', TipoVehiculoController::class);
    Route::apiResource('modelo_vehiculo', ModeloVehiculoController::class);
    Route::apiResource('vehiculos', VehiculoController::class);
    Route::apiResource('valor_comercial', ValorComercialController::class);
    Route::apiResource('depreciacion', DepreciacionController::class);
    // Rutas de pagos
    Route::apiResource('metodo_pago', MetodoPagoController::class);
    Route::apiResource('motivo_pago', MotivoPagoController::class);
    Route::apiResource('plan_pago', PlanPagoController::class);
    Route::apiResource('cuotas', CuotaController::class);
    Route::apiResource('pagos', PagoController::class);
    Route::apiResource('comprobante_pago', ComprobantePagoController::class);

    // Rutas de pólizas
    Route::apiResource('cobertura', CoberturaController::class);
    Route::apiResource('poliza', PolizaController::class);
    Route::apiResource('poliza_cobertura', PolizaCoberturaController::class);
    Route::apiResource('incidente', IncidenteController::class);

    // Rutas adicionales específicas
    Route::get('plan_pago/{id}/cuotas_pendientes', [PlanPagoController::class, 'getCuotasPendientes']);
    Route::get('plan_pago/{id}/resumen', [PlanPagoController::class, 'getResumenPago']);
    Route::get('cuotas/vencidas', [CuotaController::class, 'getCuotasVencidas']);
    Route::post('cuotas/{id}/registrar_pago', [CuotaController::class, 'registrarPago']);
    Route::get('pagos/por_fecha', [PagoController::class, 'getPagosByFecha']);
    Route::get('comprobante/{id}/download', [ComprobantePagoController::class, 'downloadComprobante']);
    Route::put('comprobante/{id}/anular', [ComprobantePagoController::class, 'anularComprobante']);
    Route::get('incidente/estadisticas', [IncidenteController::class, 'getEstadisticasPorCobertura']);
});
