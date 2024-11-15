<?php

namespace App\Http\Controllers;

use App\Models\MetodoPago;
use Illuminate\Http\Request;

class MetodoPagoController extends Controller
{
    public function index()
    {
        $metodosPago = MetodoPago::all();
        return response()->json([
            'success' => true,
            'data' => $metodosPago
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string',
            'descripcion' => 'nullable|string',
            'estado' => 'required|string',
            'configuracion_json' => 'nullable|json'
        ]);

        $metodoPago = MetodoPago::create($request->all());
        return response()->json([
            'success' => true,
            'message' => 'Método de pago creado exitosamente',
            'data' => $metodoPago
        ], 201);
    }

    public function show($id)
    {
        $metodoPago = MetodoPago::findOrFail($id);
        return response()->json([
            'success' => true,
            'data' => $metodoPago
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string',
            'descripcion' => 'nullable|string',
            'estado' => 'required|string',
            'configuracion_json' => 'nullable|json'
        ]);

        $metodoPago = MetodoPago::findOrFail($id);
        $metodoPago->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Método de pago actualizado exitosamente',
            'data' => $metodoPago
        ]);
    }

    public function destroy($id)
    {
        $metodoPago = MetodoPago::findOrFail($id);
        $metodoPago->delete();

        return response()->json([
            'success' => true,
            'message' => 'Método de pago eliminado exitosamente'
        ]);
    }
}