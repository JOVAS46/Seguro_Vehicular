<?php

namespace App\Http\Controllers;

use App\Models\Incidente;
use Illuminate\Http\Request;

class IncidenteController extends Controller
{
   public function index()
   {
       $incidentes = Incidente::with([
           'poliza', 
           'cobertura',
           'usuarioRegistro'
       ])->get();

       return response()->json([
           'success' => true,
           'data' => $incidentes
       ]);
   }

   public function store(Request $request)
   {
       $request->validate([
           'poliza_id' => 'required|exists:poliza,id',
           'fecha_incidente' => 'required|date',
           'descripcion' => 'required|string',
           'ubicacion' => 'nullable|string',
           'monto_estimado' => 'nullable|numeric|min:0',
           'estado' => 'required|string',
           'cobertura_id' => 'required|exists:cobertura,id',
           'usuario_registro_id' => 'required|exists:users,id'
       ]);

       $incidente = Incidente::create($request->all());

       return response()->json([
           'success' => true,
           'message' => 'Incidente registrado exitosamente',
           'data' => $incidente->load(['poliza', 'cobertura', 'usuarioRegistro'])
       ], 201);
   }

   public function show($id)
   {
       $incidente = Incidente::with([
           'poliza.vehiculo',
           'cobertura',
           'usuarioRegistro'
       ])->findOrFail($id);

       return response()->json([
           'success' => true,
           'data' => $incidente
       ]);
   }

   public function update(Request $request, $id)
   {
       $request->validate([
           'poliza_id' => 'required|exists:poliza,id',
           'fecha_incidente' => 'required|date',
           'descripcion' => 'required|string',
           'ubicacion' => 'nullable|string',
           'monto_estimado' => 'nullable|numeric|min:0',
           'estado' => 'required|string',
           'cobertura_id' => 'required|exists:cobertura,id',
           'usuario_registro_id' => 'required|exists:users,id'
       ]);

       $incidente = Incidente::findOrFail($id);
       $incidente->update($request->all());

       return response()->json([
           'success' => true,
           'message' => 'Incidente actualizado exitosamente',
           'data' => $incidente
       ]);
   }

   public function destroy($id)
   {
       $incidente = Incidente::findOrFail($id);
       $incidente->delete();

       return response()->json([
           'success' => true,
           'message' => 'Incidente eliminado exitosamente'
       ]);
   }

   // Métodos adicionales

   public function getIncidentesByPoliza($polizaId)
   {
       $incidentes = Incidente::where('poliza_id', $polizaId)
           ->with(['cobertura', 'usuarioRegistro'])
           ->get();

       return response()->json([
           'success' => true,
           'data' => $incidentes
       ]);
   }

   public function getIncidentesByFecha(Request $request)
   {
       $request->validate([
           'fecha_inicio' => 'required|date',
           'fecha_fin' => 'required|date|after_or_equal:fecha_inicio'
       ]);

       $incidentes = Incidente::whereBetween('fecha_incidente', [
           $request->fecha_inicio,
           $request->fecha_fin
       ])->with(['poliza', 'cobertura', 'usuarioRegistro'])->get();

       return response()->json([
           'success' => true,
           'data' => $incidentes
       ]);
   }

   public function getIncidentesPendientes()
   {
       $incidentes = Incidente::where('estado', 'pendiente')
           ->with(['poliza', 'cobertura', 'usuarioRegistro'])
           ->get();

       return response()->json([
           'success' => true,
           'data' => $incidentes
       ]);
   }

   public function actualizarEstado(Request $request, $id)
   {
       $request->validate([
           'estado' => 'required|string',
           'observacion' => 'nullable|string'
       ]);

       $incidente = Incidente::findOrFail($id);
       $incidente->update([
           'estado' => $request->estado,
           'descripcion' => $incidente->descripcion . "\n\nObservación: " . $request->observacion
       ]);

       return response()->json([
           'success' => true,
           'message' => 'Estado del incidente actualizado exitosamente',
           'data' => $incidente
       ]);
   }

   public function getEstadisticasPorCobertura()
   {
       $estadisticas = Incidente::with('cobertura')
           ->selectRaw('cobertura_id, count(*) as total, sum(monto_estimado) as monto_total')
           ->groupBy('cobertura_id')
           ->get();

       return response()->json([
           'success' => true,
           'data' => $estadisticas
       ]);
   }
}