<?php

namespace App\Http\Controllers;

use App\Models\Permiso;
use App\Models\Rol;
use App\Models\RolPermiso;
use Illuminate\Http\Request;

class RolPermisoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rolesPermiso = RolPermiso::all();
        return response()->json($rolesPermiso);
    }



    public function store(Request $request)
    {
        $rol_id = $request->id_rol;
        $permiso_id = $request->id_permiso;
        $exist = Rol::find($rol_id);
        $exist2 = Permiso::find($permiso_id);
        if ($exist && $exist2) {
            $rol_Permiso = RolPermiso::create([
                'permiso_id' => $permiso_id,
                'rol_id' => $rol_id
            ]);
            return response()->json([
                'success' => true,
                'data' => $rol_Permiso,
                'message' => 'Rol creado con éxito',
            ], 201);
        } else {
            return response()->json([
                'success' => false,
                'data' => "",
                'message' => 'Rol o Permiso Inexistentes',
            ], 201);
        }
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validar los datos recibidos
        $validatedData = $request->validate([
            'id_rol' => 'required|exists:rol,id',
            'id_permiso' => 'required|exists:permisos,id',
        ]);

        // Buscar el registro que se quiere actualizar
        $rolPermiso = RolPermiso::find($id);

        // Verificar si el registro existe
        if (!$rolPermiso) {
            return response()->json([
                'success' => false,
                'message' => 'Asociación Rol-Permiso no encontrada',
            ], 404);
        }

        // Actualizar el registro con los datos validados
        $rolPermiso->update([
            'rol_id' => $validatedData['id_rol'],
            'permiso_id' => $validatedData['id_permiso'],
        ]);

        // Retornar una respuesta JSON con los datos actualizados
        return response()->json([
            'success' => true,
            'data' => $rolPermiso,
            'message' => 'Asociación Rol-Permiso actualizada con éxito',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
         // Buscar el registro que se quiere eliminar
    $rolPermiso = RolPermiso::find($id);

    // Verificar si el registro existe
    if (!$rolPermiso) {
        return response()->json([
            'success' => false,
            'message' => 'Asociación Rol-Permiso no encontrada',
        ], 404);
    }

    // Eliminar el registro
    $rolPermiso->delete();

    // Retornar una respuesta JSON confirmando la eliminación
    return response()->json([
        'success' => true,
        'message' => 'Asociación Rol-Permiso eliminada con éxito',
    ]);
    }
}
