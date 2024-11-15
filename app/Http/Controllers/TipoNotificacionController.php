<?php

namespace App\Http\Controllers;

use App\Models\TipoNotificacion;
use Dotenv\Exception\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class TipoNotificacionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tiposNotificacion = TipoNotificacion::all();
        return response()->json($tiposNotificacion);
    }
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'nombre' => 'required|string|max:50',
                'descripcion' => 'nullable|string|max:255',
            ]);

            $tipoNotificacion = TipoNotificacion::create($validatedData);

            return response()->json([
                'success' => true,
                'message' => 'Tipo de notificación creado con éxito',
                'data' => $tipoNotificacion
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
                'message' => 'Error al crear el tipo de notificación',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function show($id)
    {
        try {
            $tipoNotificacion = TipoNotificacion::findOrFail($id);
            return response()->json([
                'success' => true,
                'data' => $tipoNotificacion
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Tipo de notificación no encontrado'
            ], 404);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $tipoNotificacion = TipoNotificacion::findOrFail($id);

            $validatedData = $request->validate([
                'nombre' => 'sometimes|required|string|max:50',
                'descripcion' => 'nullable|string|max:255',
            ]);

            $tipoNotificacion->update($validatedData);

            return response()->json([
                'success' => true,
                'message' => 'Tipo de notificación actualizado con éxito',
                'data' => $tipoNotificacion
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Tipo de notificación no encontrado'
            ], 404);
        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error de validación',
                'errors' => $e
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al actualizar el tipo de notificación',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $tipoNotificacion = TipoNotificacion::findOrFail($id);
            $tipoNotificacion->delete();

            return response()->json([
                'success' => true,
                'message' => 'Tipo de notificación eliminado con éxito'
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Tipo de notificación no encontrado'
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al eliminar el tipo de notificación',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
