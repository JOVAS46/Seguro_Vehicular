<?php

namespace App\Http\Controllers;

use App\Models\Permiso;
use App\Http\Requests\StorePermisoRequest;
use App\Http\Requests\UpdatePermisoRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PermisoController extends Controller
{
    /**
     * Mostrar una lista de permisos.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $permisos = Permiso::all(); // Obtiene todos los permisos
     
        return response()->json($permisos);
    }

    /**
     * Almacenar un nuevo permiso en la base de datos.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $validatedData = $request->validate([
            'Descripcion' => 'required|string|max:255',
        ]);

        $permiso = Permiso::create($validatedData);

        return response()->json([
            'success' => true,
            'data' => $permiso,
            'message' => 'Permiso creado con éxito',
        ], 201);
    }

    /**
     * Mostrar un permiso específico.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        $permiso = Permiso::find($id);

        if (!$permiso) {
            return response()->json([
                'success' => false,
                'message' => 'Permiso no encontrado',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $permiso,
        ]);
    }

    /**
     * Actualizar un permiso específico en la base de datos.
     *
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'Descripcion' => 'required|string|max:255',
        ]);

        $permiso = Permiso::find($id);

        if (!$permiso) {
            return response()->json([
                'success' => false,
                'message' => 'Permiso no encontrado',
            ], 404);
        }

        $permiso->update($validatedData);

        return response()->json([
            'success' => true,
            'data' => $permiso,
            'message' => 'Permiso actualizado con éxito',
        ]);
    }

    /**
     * Eliminar un permiso específico de la base de datos.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy($id)
    {
        $permiso = Permiso::find($id);

        if (!$permiso) {
            return response()->json([
                'success' => false,
                'message' => 'Permiso no encontrado',
            ], 404);
        }

        $permiso->delete();

        return response()->json([
            'success' => true,
            'message' => 'Permiso eliminado con éxito',
        ], 200);
    }
}
