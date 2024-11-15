<?php

namespace App\Http\Controllers;

use App\Models\Cobertura;
use Illuminate\Http\Request;

class CoberturaController extends Controller
{
   public function index()
   {
       $coberturas = Cobertura::all();
       return response()->json([
           'success' => true,
           'data' => $coberturas
       ]);
   }

   public function store(Request $request)
   {
       $request->validate([
           'nombre' => 'required|string',
           'descripcion' => 'nullable|string',
           'monto_maximo' => 'required|numeric',
           'estado' => 'required|string'
       ]);

       $cobertura = Cobertura::create($request->all());
       return response()->json([
           'success' => true,
           'message' => 'Cobertura creada exitosamente',
           'data' => $cobertura
       ], 201);
   }

   public function show($id)
   {
       $cobertura = Cobertura::findOrFail($id);
       return response()->json([
           'success' => true,
           'data' => $cobertura
       ]);
   }

   public function update(Request $request, $id)
   {
       $request->validate([
           'nombre' => 'required|string',
           'descripcion' => 'nullable|string',
           'monto_maximo' => 'required|numeric',
           'estado' => 'required|string'
       ]);

       $cobertura = Cobertura::findOrFail($id);
       $cobertura->update($request->all());

       return response()->json([
           'success' => true,
           'message' => 'Cobertura actualizada exitosamente',
           'data' => $cobertura
       ]);
   }

   public function destroy($id)
   {
       $cobertura = Cobertura::findOrFail($id);
       $cobertura->delete();

       return response()->json([
           'success' => true,
           'message' => 'Cobertura eliminada exitosamente'
       ]);
   }

   // Método adicional para obtener coberturas activas
   public function getActiveCoberturas()
   {
       $coberturas = Cobertura::where('estado', 'activo')->get();
       return response()->json([
           'success' => true,
           'data' => $coberturas
       ]);
   }
}