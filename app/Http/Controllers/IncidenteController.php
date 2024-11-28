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
           'tipoIncidente',
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
           'tipo_incidente_id' => 'required|exists:tipo_incidente,id',
           'fecha_incidente' => 'required|date',
           'descripcion' => 'required|string',
           'ubicacion' => 'nullable|string',
           'monto_estimado' => 'nullable|numeric|min:0',
           'estado' => 'required|string',
           'cobertura_id' => 'required|exists:cobertura,id',
           'usuario_registro_id' => 'required|exists:users,id',
           'maps_url' => 'nullable|string',
           'imagen_1' => 'nullable|string',
           'imagen_2' => 'nullable|string',
           'imagen_3' => 'nullable|string',
           'imagen_4' => 'nullable|string',
           'descripcion_imagen' => 'nullable|string',
           'fecha_reporte' => 'nullable|date',
           'estado_reporte' => 'nullable|string',
           'url_imagen' => 'nullable|string',
           'oficial_cargo' => 'nullable|string',
           'observacion' => 'nullable|string'
       ]);

       $incidente = Incidente::create($request->all());

       return response()->json([
           'success' => true,
           'message' => 'Incidente registrado exitosamente',
           'data' => $incidente->load(['poliza', 'tipoIncidente', 'cobertura', 'usuarioRegistro'])
       ], 201);
   }

   public function show($id)
   {
       $incidente = Incidente::with([
           'poliza.vehiculo',
           'tipoIncidente',
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
           'tipo_incidente_id' => 'required|exists:tipo_incidente,id',
           'fecha_incidente' => 'required|date',
           'descripcion' => 'required|string',
           'ubicacion' => 'nullable|string',
           'monto_estimado' => 'nullable|numeric|min:0',
           'estado' => 'required|string',
           'cobertura_id' => 'required|exists:cobertura,id',
           'usuario_registro_id' => 'required|exists:users,id',
           'maps_url' => 'nullable|string',
           'imagen_1' => 'nullable|string',
           'imagen_2' => 'nullable|string',
           'imagen_3' => 'nullable|string',
           'imagen_4' => 'nullable|string',
           'descripcion_imagen' => 'nullable|string',
           'fecha_reporte' => 'nullable|date',
           'estado_reporte' => 'nullable|string',
           'url_imagen' => 'nullable|string',
           'oficial_cargo' => 'nullable|string',
           'observacion' => 'nullable|string'
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

   public function getIncidentesByPoliza($polizaId)
   {
       $incidentes = Incidente::where('poliza_id', $polizaId)
           ->with(['tipoIncidente', 'cobertura', 'usuarioRegistro'])
           ->get();

       return response()->json([
           'success' => true,
           'data' => $incidentes
       ]);
   }

   public function getEstadisticasPorTipo()
   {
       $estadisticas = Incidente::with('tipoIncidente')
           ->selectRaw('tipo_incidente_id, count(*) as total, sum(monto_estimado) as monto_total')
           ->groupBy('tipo_incidente_id')
           ->get();

       return response()->json([
           'success' => true,
           'data' => $estadisticas
       ]);
   }
}