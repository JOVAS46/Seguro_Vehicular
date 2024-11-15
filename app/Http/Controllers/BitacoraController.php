<?php

namespace App\Http\Controllers;

use App\Models\Bitacora;
use Dotenv\Exception\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class BitacoraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bitacora = Bitacora::all();
        return response()->json($bitacora);
    }
    public function store(Request $request)
    {
        try {
            // Validación
            $validatedData = $request->validate([
                'usuario_id' => 'required|exists:usuario,id',
                'accion' => 'required|string|max:100',
                'detalles' => 'nullable|string',
                'ip' => 'nullable|ip'
            ]);

            // Crear bitácora
            $bitacora = Bitacora::create($validatedData);

            return response()->json([
                'success' => true,
                'message' => 'Registro en bitácora creado con éxito',
                'data' => $bitacora
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
                'message' => 'Error al crear el registro en bitácora',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $bitacora = Bitacora::findOrFail($id);

            // Validación
            $validatedData = $request->validate([
                'usuario_id' => 'sometimes|required|exists:usuario,id',
                'accion' => 'sometimes|required|string|max:100',
                'detalles' => 'nullable|string',
                'ip' => 'nullable|ip'
            ]);

            // Actualizar bitácora
            $bitacora->update($validatedData);

            return response()->json([
                'success' => true,
                'message' => 'Registro en bitácora actualizado con éxito',
                'data' => $bitacora
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Registro en bitácora no encontrado'
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
                'message' => 'Error al actualizar el registro en bitácora',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $bitacora = Bitacora::findOrFail($id);
            $bitacora->delete();

            return response()->json([
                'success' => true,
                'message' => 'Registro en bitácora eliminado con éxito'
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Registro en bitácora no encontrado'
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al eliminar el registro en bitácora',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
