<?php

namespace App\Http\Controllers;

use App\Models\PlanPago;
use Illuminate\Http\Request;

class PlanPagoController extends Controller
{
   public function index()
   {
       $planPagos = PlanPago::with(['poliza', 'usuarioRegistro', 'cuotas'])->get();
       return response()->json([
           'success' => true,
           'data' => $planPagos
       ]);
   }

   public function store(Request $request)
   {
       $request->validate([
           'poliza_id' => 'required|exists:poliza,id',
           'monto_total' => 'required|numeric|min:0',
           'fecha_inicio' => 'required|date',
           'fecha_fin' => 'required|date|after:fecha_inicio',
           'saldo' => 'required|numeric|min:0',
           'tipo_plan' => 'required|string',
           'numero_cuotas' => 'required|integer|min:1',
           'estado' => 'required|string',
           'usuario_registro_id' => 'required|exists:users,id'
       ]);

       $planPago = PlanPago::create($request->all());

       // Aquí podrías agregar lógica para generar las cuotas automáticamente
       $this->generarCuotas($planPago);

       return response()->json([
           'success' => true,
           'message' => 'Plan de pago creado exitosamente',
           'data' => $planPago->load('cuotas')
       ], 201);
   }

   public function show($id)
   {
       $planPago = PlanPago::with(['poliza', 'usuarioRegistro', 'cuotas'])->findOrFail($id);
       return response()->json([
           'success' => true,
           'data' => $planPago
       ]);
   }

   public function update(Request $request, $id)
   {
       $request->validate([
           'poliza_id' => 'required|exists:poliza,id',
           'monto_total' => 'required|numeric|min:0',
           'fecha_inicio' => 'required|date',
           'fecha_fin' => 'required|date|after:fecha_inicio',
           'saldo' => 'required|numeric|min:0',
           'tipo_plan' => 'required|string',
           'numero_cuotas' => 'required|integer|min:1',
           'estado' => 'required|string',
           'usuario_registro_id' => 'required|exists:users,id'
       ]);

       $planPago = PlanPago::findOrFail($id);
       $planPago->update($request->all());

       return response()->json([
           'success' => true,
           'message' => 'Plan de pago actualizado exitosamente',
           'data' => $planPago
       ]);
   }

   public function destroy($id)
   {
       $planPago = PlanPago::findOrFail($id);
       $planPago->delete();

       return response()->json([
           'success' => true,
           'message' => 'Plan de pago eliminado exitosamente'
       ]);
   }

   // Métodos adicionales

   private function generarCuotas($planPago)
   {
       $montoPorCuota = $planPago->monto_total / $planPago->numero_cuotas;
       $fechaVencimiento = $planPago->fecha_inicio;

       for ($i = 1; $i <= $planPago->numero_cuotas; $i++) {
           $planPago->cuotas()->create([
               'numero_cuota' => $i,
               'monto_cuota' => $montoPorCuota,
               'estado_cuota' => 'pendiente',
               'fecha_vencimiento' => $fechaVencimiento,
               'estado' => 'activo'
           ]);

           // Añade un mes a la fecha de vencimiento para la siguiente cuota
           $fechaVencimiento = date('Y-m-d', strtotime($fechaVencimiento . ' +1 month'));
       }
   }

   public function getPlanPagosByPoliza($polizaId)
   {
       $planes = PlanPago::where('poliza_id', $polizaId)
           ->with(['cuotas'])
           ->get();
           
       return response()->json([
           'success' => true,
           'data' => $planes
       ]);
   }

   public function getActivePlanPagos()
   {
       $planes = PlanPago::where('estado', 'activo')
           ->with(['poliza', 'cuotas'])
           ->get();
           
       return response()->json([
           'success' => true,
           'data' => $planes
       ]);
   }

   public function getCuotasPendientes($planPagoId)
   {
       $planPago = PlanPago::findOrFail($planPagoId);
       $cuotasPendientes = $planPago->cuotas()
           ->where('estado_cuota', 'pendiente')
           ->get();

       return response()->json([
           'success' => true,
           'data' => $cuotasPendientes
       ]);
   }

   public function getResumenPago($planPagoId)
   {
       $planPago = PlanPago::with(['cuotas', 'poliza'])->findOrFail($planPagoId);
       
       $resumen = [
           'monto_total' => $planPago->monto_total,
           'saldo_pendiente' => $planPago->saldo,
           'cuotas_totales' => $planPago->numero_cuotas,
           'cuotas_pagadas' => $planPago->cuotas->where('estado_cuota', 'pagado')->count(),
           'cuotas_pendientes' => $planPago->cuotas->where('estado_cuota', 'pendiente')->count(),
           'proxima_cuota' => $planPago->cuotas->where('estado_cuota', 'pendiente')->first()
       ];

       return response()->json([
           'success' => true,
           'data' => $resumen
       ]);
   }
}
