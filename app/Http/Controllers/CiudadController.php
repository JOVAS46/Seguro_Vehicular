<?php

namespace App\Http\Controllers;

use App\Models\Ciudad;
use Dotenv\Exception\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class CiudadController extends Controller
{
    public function index()
    {
        $ciudades = Ciudad::with('pais')->get(); // Incluye la relación con País
        return response()->json($ciudades);
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'nombre' => 'required|string|max:100',
                'pais_id' => 'required|exists:pais,id', // Valida que el país exista
            ]);

            $ciudad = Ciudad::create($validatedData);

            return response()->json([
                'success' => true,
                'message' => 'Ciudad creada con éxito',
                'data' => $ciudad
            ], 201);
        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error de validación',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al crear la ciudad',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function show($id)
    {
        try {
            $ciudad = Ciudad::with('pais')->findOrFail($id);
            return response()->json([
                'success' => true,
                'data' => $ciudad
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Ciudad no encontrada'
            ], 404);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $ciudad = Ciudad::findOrFail($id);

            $validatedData = $request->validate([
                'nombre' => 'sometimes|required|string|max:100',
                'pais_id' => 'sometimes|required|exists:pais,id',
            ]);

            $ciudad->update($validatedData);

            return response()->json([
                'success' => true,
                'message' => 'Ciudad actualizada con éxito',
                'data' => $ciudad
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Ciudad no encontrada'
            ], 404);
        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error de validación',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al actualizar la ciudad',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $ciudad = Ciudad::findOrFail($id);
            $ciudad->delete();

            return response()->json([
                'success' => true,
                'message' => 'Ciudad eliminada con éxito'
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Ciudad no encontrada'
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al eliminar la ciudad',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
