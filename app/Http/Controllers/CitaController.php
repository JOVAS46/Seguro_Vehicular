<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use Dotenv\Exception\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class CitaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cita = Cita::all();
        return response()->json($cita);
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                    'fecha' => 'required|date',
                    'duracion' => 'required|integer',
                    'motivo' => 'nullable|string|max:255',
                    'estado' => 'required|string|max:20',
                    'fechaCreacion' => 'required|date',
                    'solicitante_id' => 'required|exists:usuario,id',
                    'recepcion_id' => 'required|exists:usuario,id',
                    'tipoCita_id' => 'nullable|exists:tipo_cita,id',
            ]);

            $cita = Cita::create($validatedData);

            return response()->json([
                'success' => true,
                'message' => 'Cita creada exitosamente',
                'data' => $cita
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
                'message' => 'Error al crear la cita',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function show($id)
    {
        try {
            $cita = Cita::with(['solicitante', 'recepcion', 'tipoCita'])->findOrFail($id);
            return response()->json([
                'success' => true,
                'data' => $cita
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Cita no encontrada'
            ], 404);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $cita = Cita::findOrFail($id);

            $validatedData = $request->validate([
                'fecha' => 'sometimes|required|date',
                'duracion' => 'sometimes|required|integer',
                'motivo' => 'nullable|string|max:255',
                'estado' => 'sometimes|required|string|max:20',
                'fechaCreacion' => 'sometimes|required|date',
                'solicitante_id' => 'sometimes|required|exists:usuario,id',
                'recepcion_id' => 'sometimes|required|exists:usuario,id',
                'tipoCita_id' => 'nullable|exists:tipo_cita,id',
            ]);

            $cita->update($validatedData);

            return response()->json([
                'success' => true,
                'message' => 'Cita actualizada exitosamente',
                'data' => $cita
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Cita no encontrada'
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
                'message' => 'Error al actualizar la cita',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $cita = Cita::findOrFail($id);
            $cita->delete();

            return response()->json([
                'success' => true,
                'message' => 'Cita eliminada exitosamente'
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Cita no encontrada'
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al eliminar la cita',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
