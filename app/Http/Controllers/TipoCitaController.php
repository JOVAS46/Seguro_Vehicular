<?php

namespace App\Http\Controllers;

use App\Models\TipoCita;
use Dotenv\Exception\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class TipoCitaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tiposCita = TipoCita::all();
        return response()->json($tiposCita);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'nombre' => 'required|string|max:50|unique:tipo_cita,nombre',
                'descripcion' => 'nullable|string|max:255',
            ]);

            $tipoCita = TipoCita::create($validatedData);

            return response()->json([
                'success' => true,
                'message' => 'Tipo de cita creado exitosamente',
                'data' => $tipoCita
            ], 201);
        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error de validación',
                'errors' => $e
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al crear el tipo de cita',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, string $id)
    {
        try {
            $tipoCita = TipoCita::findOrFail($id);

            $validatedData = $request->validate([
                'nombre' => 'required|string|max:50|unique:tipo_cita,nombre,' . $id,
                'descripcion' => 'nullable|string|max:255',
            ]);

            $tipoCita->update($validatedData);

            return response()->json([
                'success' => true,
                'message' => 'Tipo de cita actualizado exitosamente',
                'data' => $tipoCita
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Tipo de cita no encontrado'
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
                'message' => 'Error al actualizar el tipo de cita',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy(string $id)
    {
        try {
            $tipoCita = TipoCita::findOrFail($id);
            $tipoCita->delete();

            return response()->json([
                'success' => true,
                'message' => 'Tipo de cita eliminado exitosamente'
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Tipo de cita no encontrado'
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al eliminar el tipo de cita',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
