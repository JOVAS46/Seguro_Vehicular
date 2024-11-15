<?php

namespace App\Http\Controllers;

use App\Models\PolizaCobertura;
use Illuminate\Http\Request;

class PolizaCoberturaController extends Controller
{
   public function index()
   {
       $polizaCoberturas = PolizaCobertura::with(['poliza', 'cobertura'])->get();
       return response()->json([
           'success' => true,
           'data' => $polizaCoberturas
       ]);
   }

   public function store(Request $request)
   {
       $request->validate([
           'poliza_id' => 'required|exists:poliza,id',
           'cobertura_id' => 'required|exists:cobertura,id',
           'monto_cobertura' => 'required|numeric|min:0',
           'estado' => 'required|string'
       ]);

       $polizaCobertura = PolizaCobertura::create($request->all());
       return response()->json([
           'success' => true,
           'message' => 'Cobertura de póliza creada exitosamente',
           'data' => $polizaCobertura
       ], 201);
   }

   public function show($id)
   {
       $polizaCobertura = PolizaCobertura::with(['poliza', 'cobertura'])->findOrFail($id);
       return response()->json([
           'success' => true,
           'data' => $polizaCobertura
       ]);
   }

   public function update(Request $request, $id)
   {
       $request->validate([
           'poliza_id' => 'required|exists:poliza,id',
           'cobertura_id' => 'required|exists:cobertura,id',
           'monto_cobertura' => 'required|numeric|min:0',
           'estado' => 'required|string'
       ]);

       $polizaCobertura = PolizaCobertura::findOrFail($id);
       $polizaCobertura->update($request->all());

       return response()->json([
           'success' => true,
           'message' => 'Cobertura de póliza actualizada exitosamente',
           'data' => $polizaCobertura
       ]);
   }

   public function destroy($id)
   {
       $polizaCobertura = PolizaCobertura::findOrFail($id);
       $polizaCobertura->delete();

       return response()->json([
           'success' => true,
           'message' => 'Cobertura de póliza eliminada exitosamente'
       ]);
   }

   // Métodos adicionales

   public function getCoberturasByPoliza($polizaId)
   {
       $coberturas = PolizaCobertura::where('poliza_id', $polizaId)
           ->with('cobertura')
           ->get();
           
       return response()->json([
           'success' => true,
           'data' => $coberturas
       ]);
   }

   public function getActiveCoberturasByPoliza($polizaId)
   {
       $coberturas = PolizaCobertura::where('poliza_id', $polizaId)
           ->where('estado', 'activo')
           ->with('cobertura')
           ->get();
           
       return response()->json([
           'success' => true,
           'data' => $coberturas
       ]);
   }
}