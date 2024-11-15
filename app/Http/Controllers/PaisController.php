<?php

namespace App\Http\Controllers;

use App\Models\Pais;
use Dotenv\Exception\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class PaisController extends Controller
{
    public function index()
    {
        $paises = Pais::all();
        return response()->json($paises);
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'nombre' => 'required|string|max:100',
            ]);

            $pais = Pais::create($validatedData);

            return response()->json([
                'success' => true,
                'message' => 'País creado con éxito',
                'data' => $pais
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
                'message' => 'Error al crear el país',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function show($id)
    {
        try {
            $pais = Pais::findOrFail($id);
            return response()->json([
                'success' => true,
                'data' => $pais
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'País no encontrado'
            ], 404);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $pais = Pais::findOrFail($id);

            $validatedData = $request->validate([
                'nombre' => 'sometimes|required|string|max:100',
            ]);

            $pais->update($validatedData);

            return response()->json([
                'success' => true,
                'message' => 'País actualizado con éxito',
                'data' => $pais
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'País no encontrado'
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
                'message' => 'Error al actualizar el país',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $pais = Pais::findOrFail($id);
            $pais->delete();

            return response()->json([
                'success' => true,
                'message' => 'País eliminado con éxito'
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'País no encontrado'
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al eliminar el país',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
