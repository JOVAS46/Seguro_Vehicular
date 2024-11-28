<?php

namespace App\Http\Controllers;

use App\Models\TipoIncidente;
use Illuminate\Http\Request;

class TipoIncidenteController extends Controller
{
    public function index()
    {
        $tiposIncidente = TipoIncidente::all();
        return response()->json([
            'success' => true,
            'data' => $tiposIncidente
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string',
            'descripcion' => 'nullable|string',
            'estado' => 'required|string'
        ]);

        $tipoIncidente = TipoIncidente::create($request->all());
        return response()->json([
            'success' => true,
            'message' => 'Tipo de incidente creado exitosamente',
            'data' => $tipoIncidente
        ], 201);
    }

    public function show($id)
    {
        $tipoIncidente = TipoIncidente::with('incidentes')->findOrFail($id);
        return response()->json([
            'success' => true,
            'data' => $tipoIncidente
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string',
            'descripcion' => 'nullable|string',
            'estado' => 'required|string'
        ]);

        $tipoIncidente = TipoIncidente::findOrFail($id);
        $tipoIncidente->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Tipo de incidente actualizado exitosamente',
            'data' => $tipoIncidente
        ]);
    }

    public function destroy($id)
    {
        $tipoIncidente = TipoIncidente::findOrFail($id);
        $tipoIncidente->delete();

        return response()->json([
            'success' => true,
            'message' => 'Tipo de incidente eliminado exitosamente'
        ]);
    }
}
