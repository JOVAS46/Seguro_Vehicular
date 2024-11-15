<?php

namespace App\Http\Controllers;

use App\Models\Rol;
use App\Http\Requests\StoreRolRequest;
use App\Http\Requests\UpdateRolRequest;
use Illuminate\Http\Request;

class RolController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Rol::all();
        return response()->json($roles);
    }

    // Almacenar un nuevo rol en la base de datos
    public function store(Request $request)
    {
        // Validación de los datos recibidos en la solicitud
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255',
        ]);
    
        // Creación del nuevo rol con los datos validados
        $rol = Rol::create([
            'nombre' => $validatedData['nombre'],
        ]);
    
        // Respuesta JSON con el rol creado y un código de estado 201 (Creado)
        return response()->json([
            'success' => true,
            'data' => $rol,
            'message' => 'Rol creado con éxito',
        ], 201);
    }
    

    // Mostrar un rol específico
    public function show($id)
    {
        $rol = Rol::find($id);

        if (!$rol) {
            return response()->json(['message' => 'Rol no encontrado'], 404);
        }

        return response()->json($rol); // Devuelve el rol encontrado
    }

    // Actualizar un rol específico en la base de datos
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
        ]);

        $rol = Rol::find($id);

        if (!$rol) {
            return response()->json(['message' => 'Rol no encontrado'], 404);
        }

        $rol->update([
            'nombre' => $request->input('nombre'),
        ]);

        return response()->json($rol); // Devuelve el rol actualizado
    }

    // Eliminar un rol específico de la base de datos
    public function destroy($id)
    {
        $rol = Rol::find($id);

        if (!$rol) {
            return response()->json(['message' => 'Rol no encontrado'], 404);
        }

        $rol->delete();

        return response()->json(['message' => 'Rol eliminado'], 200); // Devuelve un mensaje de éxito
    }
}
