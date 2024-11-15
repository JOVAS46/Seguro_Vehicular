<?php

namespace App\Http\Controllers;

use App\Models\Notificacion;
use Dotenv\Exception\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class NotificacionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $notificacion = Notificacion::all();
        return response()->json($notificacion);
    }
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'mensaje' => 'required|string|max:255',
                'fechaEnvio' => 'nullable|date',
                'fechaCreacion' => 'nullable|date',
                'estado' => 'nullable|string|max:20',
                'tipo_id' => 'required|exists:tipo_notificacion,id',
                'usuario_id' => 'required|exists:usuario,id',
            ]);

            $notificacion = Notificacion::create($validatedData);

            return response()->json([
                'success' => true,
                'message' => 'Notificación creada exitosamente',
                'data' => $notificacion
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
                'message' => 'Error al crear la notificación',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function show($id)
    {
        try {
            $notificacion = Notificacion::with(['tipoNotificacion', 'usuario'])->findOrFail($id);
            return response()->json([
                'success' => true,
                'data' => $notificacion
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Notificación no encontrada'
            ], 404);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $notificacion = Notificacion::findOrFail($id);

            $validatedData = $request->validate([
                'mensaje' => 'sometimes|required|string|max:255',
                'fechaEnvio' => 'nullable|date',
                'fechaCreacion' => 'nullable|date',
                'estado' => 'nullable|string|max:20',
                'tipo_id' => 'sometimes|required|exists:tipo_notificacion,id',
                'usuario_id' => 'sometimes|required|exists:usuario,id',
            ]);

            $notificacion->update($validatedData);

            return response()->json([
                'success' => true,
                'message' => 'Notificación actualizada con éxito',
                'data' => $notificacion
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Notificación no encontrada'
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
                'message' => 'Error al actualizar la notificación',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $notificacion = Notificacion::findOrFail($id);
            $notificacion->delete();

            return response()->json([
                'success' => true,
                'message' => 'Notificación eliminada con éxito'
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Notificación no encontrada'
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al eliminar la notificación',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
