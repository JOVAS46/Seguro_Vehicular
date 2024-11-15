<?php

namespace App\Http\Controllers;

use App\Models\Cuota;
use Illuminate\Http\Request;

class CuotaController extends Controller
{
   public function index()
   {
       $cuotas = Cuota::with(['planPago', 'pagos'])->get();
       return response()->json([
           'success' => true,
           'data' => $cuotas
       ]);
   }

   public function store(Request $request)
   {
       $request->validate([
           'plan_pago_id' => 'required|exists:plan_pago,id',
           'numero_cuota' => 'required|integer|min:1',
           'monto_cuota' => 'required|numeric|min:0',
           'estado_cuota' => 'required|string',
           'fecha_vencimiento' => 'required|date',
           'fecha_pago' => 'nullable|date',
           'estado' => 'required|string'
       ]);

       $cuota = Cuota::create($request->all());
       return response()->json([
           'success' => true,
           'message' => 'Cuota creada exitosamente',
           'data' => $cuota
       ], 201);
   }

   public function show($id)
   {
       $cuota = Cuota::with(['planPago', 'pagos'])->findOrFail($id);
       return response()->json([
           'success' => true,
           'data' => $cuota
       ]);
   }

   public function update(Request $request, $id)
   {
       $request->validate([
           'plan_pago_id' => 'required|exists:plan_pago,id',
           'numero_cuota' => 'required|integer|min:1',
           'monto_cuota' => 'required|numeric|min:0',
           'estado_cuota' => 'required|string',
           'fecha_vencimiento' => 'required|date',
           'fecha_pago' => 'nullable|date',
           'estado' => 'required|string'
       ]);

       $cuota = Cuota::findOrFail($id);
       $cuota->update($request->all());

       return response()->json([
           'success' => true,
           'message' => 'Cuota actualizada exitosamente',
           'data' => $cuota
       ]);
   }

   public function destroy($id)
   {
       $cuota = Cuota::findOrFail($id);
       $cuota->delete();

       return response()->json([
           'success' => true,
           'message' => 'Cuota eliminada exitosamente'
       ]);
   }

   // Métodos adicionales

   public function getCuotasByPlanPago($planPagoId)
   {
       $cuotas = Cuota::where('plan_pago_id', $planPagoId)
           ->orderBy('numero_cuota')
           ->get();
           
       return response()->json([
           'success' => true,
           'data' => $cuotas
       ]);
   }

   public function getCuotasVencidas()
   {
       $cuotas = Cuota::where('estado_cuota', 'pendiente')
           ->whereDate('fecha_vencimiento', '<', now())
           ->with(['planPago.poliza'])
           ->get();
           
       return response()->json([
           'success' => true,
           'data' => $cuotas
       ]);
   }

   public function getCuotasPendientes()
   {
       $cuotas = Cuota::where('estado_cuota', 'pendiente')
           ->whereDate('fecha_vencimiento', '>=', now())
           ->with(['planPago.poliza'])
           ->orderBy('fecha_vencimiento')
           ->get();
           
       return response()->json([
           'success' => true,
           'data' => $cuotas
       ]);
   }

   public function registrarPago(Request $request, $id)
   {
       $request->validate([
           'fecha_pago' => 'required|date',
           'monto_pagado' => 'required|numeric|min:0'
       ]);

       $cuota = Cuota::findOrFail($id);
       
       if ($cuota->estado_cuota === 'pagado') {
           return response()->json([
               'success' => false,
               'message' => 'Esta cuota ya está pagada'
           ], 400);
       }

       $cuota->update([
           'estado_cuota' => 'pagado',
           'fecha_pago' => $request->fecha_pago
       ]);

       // Actualizar saldo del plan de pago
       $planPago = $cuota->planPago;
       $planPago->saldo -= $cuota->monto_cuota;
       $planPago->save();

       return response()->json([
           'success' => true,
           'message' => 'Pago registrado exitosamente',
           'data' => $cuota
       ]);
   }
}
