<?php

namespace App\Http\Controllers;

use App\Models\Poliza;
use Illuminate\Http\Request;

class PolizaController extends Controller
{
    public function index()
    {
        $polizas = Poliza::with(['vehiculo', 'usuarioRegistro', 'polizaCoberturas.cobertura'])->get();
        return response()->json([
            'success' => true,
            'data' => $polizas
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'numero_poliza' => 'required|string|unique:poliza',
            'vehiculo_id' => 'required|exists:vehiculo,id',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after:fecha_inicio',
            'monto_total' => 'required|numeric|min:0',
            'prima_mensual' => 'required|numeric|min:0',
            'estado' => 'required|string',
            'documento_url' => 'nullable|string',
            'usuario_registro_id' => 'required|exists:users,id'
        ]);

        $poliza = Poliza::create($request->all());
        return response()->json([
            'success' => true,
            'message' => 'Póliza creada exitosamente',
            'data' => $poliza
        ], 201);
    }

    public function show($id)
    {
        $poliza = Poliza::with(['vehiculo', 'usuarioRegistro', 'polizaCoberturas.cobertura', 'planPagos', 'incidentes'])
            ->findOrFail($id);
        return response()->json([
            'success' => true,
            'data' => $poliza
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'numero_poliza' => 'required|string|unique:poliza,numero_poliza,'.$id,
            'vehiculo_id' => 'required|exists:vehiculo,id',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after:fecha_inicio',
            'monto_total' => 'required|numeric|min:0',
            'prima_mensual' => 'required|numeric|min:0',
            'estado' => 'required|string',
            'documento_url' => 'nullable|string',
            'usuario_registro_id' => 'required|exists:users,id'
        ]);

        $poliza = Poliza::findOrFail($id);
        $poliza->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Póliza actualizada exitosamente',
            'data' => $poliza
        ]);
    }

    public function destroy($id)
    {
        $poliza = Poliza::findOrFail($id);
        $poliza->delete();

        return response()->json([
            'success' => true,
            'message' => 'Póliza eliminada exitosamente'
        ]);
    }

    // Métodos adicionales

    public function getActivePolizas()
    {
        $polizas = Poliza::where('estado', 'activo')
            ->whereDate('fecha_fin', '>=', now())
            ->with(['vehiculo', 'usuarioRegistro'])
            ->get();
            
        return response()->json([
            'success' => true,
            'data' => $polizas
        ]);
    }

    public function getPolizasByVehiculo($vehiculoId)
    {
        $polizas = Poliza::where('vehiculo_id', $vehiculoId)
            ->with(['polizaCoberturas.cobertura'])
            ->get();
            
        return response()->json([
            'success' => true,
            'data' => $polizas
        ]);
    }

    public function getPolizasVencidas()
    {
        $polizas = Poliza::whereDate('fecha_fin', '<', now())
            ->with(['vehiculo', 'usuarioRegistro'])
            ->get();
            
        return response()->json([
            'success' => true,
            'data' => $polizas
        ]);
    }
}