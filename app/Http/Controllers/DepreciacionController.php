<?php

namespace App\Http\Controllers;

use App\Models\Depreciacion;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class DepreciacionController extends Controller
{
    public function index()
    {
        $depreciaciones = Depreciacion::with('valorComercial')->get();
        return response()->json($depreciaciones);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'valor_comercial_id' => 'required|exists:valor_comercial,id',
            'valor_inicial' => 'required|numeric',
            'valor_depreciado' => 'required|numeric',
            'fecha_depreciacion' => 'required|date',
            'motivo_depreciacion' => 'required|string|max:255',
        ]);

        $depreciacion = Depreciacion::create($validatedData);

        return response()->json([
            'success' => true,
            'data' => $depreciacion,
            'message' => 'Depreciación creada con éxito',
        ], 201);
    }

    public function show($id)
    {
        try {
            $depreciacion = Depreciacion::with('valorComercial')->findOrFail($id);
            return response()->json($depreciacion);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Depreciación no encontrada',
            ], 404);
        }
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'valor_comercial_id' => 'sometimes|required|exists:valor_comercial,id',
            'valor_inicial' => 'sometimes|required|numeric',
            'valor_depreciado' => 'sometimes|required|numeric',
            'fecha_depreciacion' => 'sometimes|required|date',
            'motivo_depreciacion' => 'sometimes|required|string|max:255',
        ]);

        $depreciacion = Depreciacion::findOrFail($id);
        $depreciacion->update($validatedData);

        return response()->json([
            'success' => true,
            'data' => $depreciacion,
            'message' => 'Depreciación actualizada con éxito',
        ]);
    }

    public function destroy($id)
    {
        $depreciacion = Depreciacion::findOrFail($id);
        $depreciacion->delete();

        return response()->json([
            'success' => true,
            'message' => 'Depreciación eliminada con éxito',
        ]);
    }
}
