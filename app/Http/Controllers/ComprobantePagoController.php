<?php

namespace App\Http\Controllers;

use App\Models\ComprobantePago;
use Illuminate\Http\Request;

class ComprobantePagoController extends Controller
{
   public function index()
   {
       $comprobantes = ComprobantePago::with(['pago'])->get();
       return response()->json([
           'success' => true,
           'data' => $comprobantes
       ]);
   }

   public function store(Request $request)
   {
       $request->validate([
           'pago_id' => 'required|exists:pago,id',
           'numero_comprobante' => 'nullable|string',
           'fecha_emision' => 'required|date',
           'monto_total' => 'required|numeric|min:0',
           'detalles_json' => 'nullable|json',
           'estado' => 'required|string'
       ]);

       $comprobante = ComprobantePago::create($request->all());
       
       return response()->json([
           'success' => true,
           'message' => 'Comprobante creado exitosamente',
           'data' => $comprobante->load('pago')
       ], 201);
   }

   public function show($id)
   {
       $comprobante = ComprobantePago::with([
           'pago.cuota.planPago.poliza',
           'pago.metodoPago',
           'pago.motivoPago'
       ])->findOrFail($id);

       return response()->json([
           'success' => true,
           'data' => $comprobante
       ]);
   }

   public function update(Request $request, $id)
   {
       $request->validate([
           'pago_id' => 'required|exists:pago,id',
           'numero_comprobante' => 'nullable|string',
           'fecha_emision' => 'required|date',
           'monto_total' => 'required|numeric|min:0',
           'detalles_json' => 'nullable|json',
           'estado' => 'required|string'
       ]);

       $comprobante = ComprobantePago::findOrFail($id);
       $comprobante->update($request->all());

       return response()->json([
           'success' => true,
           'message' => 'Comprobante actualizado exitosamente',
           'data' => $comprobante
       ]);
   }

   public function destroy($id)
   {
       $comprobante = ComprobantePago::findOrFail($id);
       $comprobante->delete();

       return response()->json([
           'success' => true,
           'message' => 'Comprobante eliminado exitosamente'
       ]);
   }

   // Métodos adicionales

   public function getComprobantesByFecha(Request $request)
   {
       $request->validate([
           'fecha_inicio' => 'required|date',
           'fecha_fin' => 'required|date|after_or_equal:fecha_inicio'
       ]);

       $comprobantes = ComprobantePago::whereBetween('fecha_emision', [
           $request->fecha_inicio,
           $request->fecha_fin
       ])->with(['pago'])->get();

       return response()->json([
           'success' => true,
           'data' => $comprobantes
       ]);
   }

   public function getComprobantesByPoliza($polizaId)
   {
       $comprobantes = ComprobantePago::whereHas('pago.cuota.planPago', function($query) use ($polizaId) {
           $query->where('poliza_id', $polizaId);
       })->with(['pago'])->get();

       return response()->json([
           'success' => true,
           'data' => $comprobantes
       ]);
   }

   public function downloadComprobante($id)
   {
       $comprobante = ComprobantePago::with([
           'pago.cuota.planPago.poliza',
           'pago.metodoPago',
           'pago.motivoPago'
       ])->findOrFail($id);

       // Aquí iría la lógica para generar el PDF del comprobante
       // Por ahora solo retornamos los datos

       return response()->json([
           'success' => true,
           'message' => 'Función de descarga en desarrollo',
           'data' => $comprobante
       ]);
   }

   public function anularComprobante($id)
   {
       $comprobante = ComprobantePago::findOrFail($id);
       
       if ($comprobante->estado === 'anulado') {
           return response()->json([
               'success' => false,
               'message' => 'El comprobante ya está anulado'
           ], 400);
       }

       $comprobante->update(['estado' => 'anulado']);

       return response()->json([
           'success' => true,
           'message' => 'Comprobante anulado exitosamente',
           'data' => $comprobante
       ]);
   }
}
