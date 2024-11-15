<?php

namespace App\Http\Controllers;

use App\Models\Pago;
use Illuminate\Http\Request;

class PagoController extends Controller
{
   public function index()
   {
       $pagos = Pago::with([
           'cuota', 
           'metodoPago', 
           'motivoPago',
           'usuarioRegistro',
           'comprobantePago'
       ])->get();

       return response()->json([
           'success' => true,
           'data' => $pagos
       ]);
   }

   public function store(Request $request)
   {
       $request->validate([
           'cuota_id' => 'required|exists:cuota,id',
           'metodo_pago_id' => 'required|exists:metodo_pago,id',
           'motivo_pago_id' => 'required|exists:motivo_pago,id',
           'usuario_registro_id' => 'required|exists:users,id',
           'fecha' => 'required|date',
           'monto' => 'required|numeric|min:0',
           'notas' => 'nullable|string',
           'estado' => 'required|string',
           'comprobante_pago' => 'nullable|string'
       ]);

       $pago = Pago::create($request->all());

       // Actualizar estado de la cuota
       $cuota = $pago->cuota;
       $cuota->update([
           'estado_cuota' => 'pagado',
           'fecha_pago' => $pago->fecha
       ]);

       // Actualizar saldo del plan de pago
       $planPago = $cuota->planPago;
       $planPago->saldo -= $pago->monto;
       $planPago->save();

       return response()->json([
           'success' => true,
           'message' => 'Pago registrado exitosamente',
           'data' => $pago->load(['cuota', 'metodoPago', 'motivoPago'])
       ], 201);
   }

   public function show($id)
   {
       $pago = Pago::with([
           'cuota.planPago.poliza', 
           'metodoPago', 
           'motivoPago',
           'usuarioRegistro',
           'comprobantePago'
       ])->findOrFail($id);

       return response()->json([
           'success' => true,
           'data' => $pago
       ]);
   }

   public function update(Request $request, $id)
   {
       $request->validate([
           'cuota_id' => 'required|exists:cuota,id',
           'metodo_pago_id' => 'required|exists:metodo_pago,id',
           'motivo_pago_id' => 'required|exists:motivo_pago,id',
           'usuario_registro_id' => 'required|exists:users,id',
           'fecha' => 'required|date',
           'monto' => 'required|numeric|min:0',
           'notas' => 'nullable|string',
           'estado' => 'required|string',
           'comprobante_pago' => 'nullable|string'
       ]);

       $pago = Pago::findOrFail($id);
       $pago->update($request->all());

       return response()->json([
           'success' => true,
           'message' => 'Pago actualizado exitosamente',
           'data' => $pago
       ]);
   }

   public function destroy($id)
   {
       $pago = Pago::findOrFail($id);
       
       // Revertir estado de la cuota si se elimina el pago
       $cuota = $pago->cuota;
       $cuota->update([
           'estado_cuota' => 'pendiente',
           'fecha_pago' => null
       ]);

       // Revertir saldo del plan de pago
       $planPago = $cuota->planPago;
       $planPago->saldo += $pago->monto;
       $planPago->save();

       $pago->delete();

       return response()->json([
           'success' => true,
           'message' => 'Pago eliminado exitosamente'
       ]);
   }

   // Métodos adicionales

   public function getPagosByPoliza($polizaId)
   {
       $pagos = Pago::whereHas('cuota.planPago', function($query) use ($polizaId) {
           $query->where('poliza_id', $polizaId);
       })->with(['cuota', 'metodoPago', 'motivoPago'])->get();

       return response()->json([
           'success' => true,
           'data' => $pagos
       ]);
   }

   public function getPagosByFecha(Request $request)
   {
       $request->validate([
           'fecha_inicio' => 'required|date',
           'fecha_fin' => 'required|date|after_or_equal:fecha_inicio'
       ]);

       $pagos = Pago::whereBetween('fecha', [$request->fecha_inicio, $request->fecha_fin])
           ->with(['cuota', 'metodoPago', 'motivoPago'])
           ->get();

       return response()->json([
           'success' => true,
           'data' => $pagos
       ]);
   }

   public function getPagosByMetodo($metodoId)
   {
       $pagos = Pago::where('metodo_pago_id', $metodoId)
           ->with(['cuota', 'metodoPago', 'motivoPago'])
           ->get();

       return response()->json([
           'success' => true,
           'data' => $pagos
       ]);
   }
}
