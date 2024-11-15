<?php

namespace App\Http\Controllers;

use App\Models\MotivoPago;
use Illuminate\Http\Request;

class MotivoPagoController extends Controller
{
   public function index()
   {
       $motivosPago = MotivoPago::all();
       return response()->json([
           'success' => true,
           'data' => $motivosPago
       ]);
   }

   public function store(Request $request)
   {
       $request->validate([
           'descripcion' => 'required|string',
           'estado' => 'required|string'
       ]);

       $motivoPago = MotivoPago::create($request->all());
       return response()->json([
           'success' => true,
           'message' => 'Motivo de pago creado exitosamente',
           'data' => $motivoPago
       ], 201);
   }

   public function show($id)
   {
       $motivoPago = MotivoPago::findOrFail($id);
       return response()->json([
           'success' => true,
           'data' => $motivoPago
       ]);
   }

   public function update(Request $request, $id)
   {
       $request->validate([
           'descripcion' => 'required|string',
           'estado' => 'required|string'
       ]);

       $motivoPago = MotivoPago::findOrFail($id);
       $motivoPago->update($request->all());

       return response()->json([
           'success' => true,
           'message' => 'Motivo de pago actualizado exitosamente',
           'data' => $motivoPago
       ]);
   }

   public function destroy($id)
   {
       $motivoPago = MotivoPago::findOrFail($id);
       $motivoPago->delete();

       return response()->json([
           'success' => true,
           'message' => 'Motivo de pago eliminado exitosamente'
       ]);
   }

   // Método adicional para obtener motivos de pago activos
   public function getActiveMotivos()
   {
       $motivos = MotivoPago::where('estado', 'activo')->get();
       return response()->json([
           'success' => true,
           'data' => $motivos
       ]);
   }
}
