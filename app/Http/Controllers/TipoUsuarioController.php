<?php

namespace App\Http\Controllers;

use App\Models\TipoUsuario;
use Illuminate\Http\Request;

class TipoUsuarioController extends Controller
{
    
   public function index()
   {
       $tiposUsuario = TipoUsuario::all();
       return response()->json($tiposUsuario);
   }

   /**
    * Store a newly created resource in storage.
    *
    * @param \Illuminate\Http\Request $request
    * @return \Illuminate\Http\Response
    */
   public function store(Request $request)
   {
       // Validar los datos recibidos
       $validatedData = $request->validate([
           'nombre' => 'required|string|max:255',
       ]);

       // Crear un nuevo registro en la tabla tipo_usuario
       $tipoUsuario = TipoUsuario::create($validatedData);

       // Retornar una respuesta JSON con el nuevo registro creado
       return response()->json([
           'success' => true,
           'data' => $tipoUsuario,
           'message' => 'Tipo de Usuario creado con éxito',
       ], 201);
   }

   /**
    * Update the specified resource in storage.
    *
    * @param \Illuminate\Http\Request $request
    * @param int $id
    * @return \Illuminate\Http\Response
    */
   public function update(Request $request, $id)
   {
       // Validar los datos recibidos
       $validatedData = $request->validate([
           'nombre' => 'required|string|max:255',
       ]);

       // Buscar el registro que se quiere actualizar
       $tipoUsuario = TipoUsuario::find($id);

       // Verificar si el registro existe
       if (!$tipoUsuario) {
           return response()->json([
               'success' => false,
               'message' => 'Tipo de Usuario no encontrado',
           ], 404);
       }

       // Actualizar el registro con los datos validados
       $tipoUsuario->update($validatedData);

       // Retornar una respuesta JSON con los datos actualizados
       return response()->json([
           'success' => true,
           'data' => $tipoUsuario,
           'message' => 'Tipo de Usuario actualizado con éxito',
       ]);
   }

   /**
    * Remove the specified resource from storage.
    *
    * @param int $id
    * @return \Illuminate\Http\Response
    */
   public function destroy($id)
   {
       // Buscar el registro que se quiere eliminar
       $tipoUsuario = TipoUsuario::find($id);

       // Verificar si el registro existe
       if (!$tipoUsuario) {
           return response()->json([
               'success' => false,
               'message' => 'Tipo de Usuario no encontrado',
           ], 404);
       }

       // Eliminar el registro
       $tipoUsuario->delete();

       // Retornar una respuesta JSON confirmando la eliminación
       return response()->json([
           'success' => true,
           'message' => 'Tipo de Usuario eliminado con éxito',
       ]);
   }
}
