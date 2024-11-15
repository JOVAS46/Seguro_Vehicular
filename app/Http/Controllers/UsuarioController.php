<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Dotenv\Exception\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $usuario = Usuario::all();
        return response()->json($usuario);
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'nombre' => 'required|string|max:255',
                'apellido' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:usuario,email',
                'contrasena' => 'nullable|string|min:6',
                'estado' => 'required|string|max:50',
                'ci' => 'nullable|integer',
                'celular' => 'nullable|integer',
                'direccion' => 'nullable|string|max:255',
                'tipoUsuario_id' => 'required|integer|exists:tipo_usuario,id',
                'rol_id' => 'required|integer|exists:rol,id',
                'pais_id' => 'nullable|integer|exists:pais,id',
                'ciudad_id' => 'nullable|integer|exists:ciudad,id',
                'user_id' => 'nullable|integer|exists:users,id',  // Asegura que 'user_id' exista en la tabla 'users', si se proporciona

            ]);

            $usuario = Usuario::create($validatedData);

            return response()->json([
                'success' => true,
                'data' => $usuario,
                'message' => 'Usuario creado con éxito',
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
                'message' => 'Error al crear el usuario',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $usuario = Usuario::findOrFail($id);
            return response()->json([
                'success' => true,
                'data' => $usuario
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Usuario no encontrado'
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $usuario = Usuario::findOrFail($id);

            $validatedData = $request->validate([
                'nombre' => 'sometimes|required|string|max:255',
                'apellido' => 'sometimes|required|string|max:255',
                'email' => 'sometimes|required|string|email|max:255|unique:usuario,email,' . $id,
                'contrasena' => 'nullable|string|min:6',
                'estado' => 'sometimes|required|string|max:50',
                'ci' => 'nullable|integer',
                'celular' => 'nullable|integer',
                'direccion' => 'nullable|string|max:255',
                'tipoUsuario_id' => 'sometimes|required|integer|exists:tipo_usuario,id',
                'rol_id' => 'sometimes|required|integer|exists:rol,id',
                'pais_id' => 'nullable|integer|exists:pais,id',
                'ciudad_id' => 'nullable|integer|exists:ciudad,id',

            ]);

            $usuario->update($validatedData);

            return response()->json([
                'success' => true,
                'data' => $usuario,
                'message' => 'Usuario actualizado con éxito',
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Usuario no encontrado'
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
                'message' => 'Error al actualizar el usuario',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $usuario = Usuario::findOrFail($id);
            $usuario->delete();

            return response()->json([
                'success' => true,
                'message' => 'Usuario eliminado con éxito'
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Usuario no encontrado'
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al eliminar el usuario',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
