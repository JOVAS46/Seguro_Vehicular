<?php

namespace App\Http\Controllers;

use App\Models\TipoVehiculo;
use App\Http\Requests\StoreTipoVehiculoRequest;
use App\Http\Requests\UpdateTipoVehiculoRequest;
use Illuminate\Http\Request;

class TipoVehiculoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $TiposVehiculos = TipoVehiculo::all();
        return response()->json($TiposVehiculos);
    }

    // Almacenar un nuevo rol en la base de datos
    public function store(Request $request)
    {
        // Validación de los datos recibidos en la solicitud
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255',
        ]);
    
        // Creación del nuevo rol con los datos validados
        $TipoVehiculo = TipoVehiculo::create([
            'nombre' => $validatedData['nombre'],
        ]);
    
        // Respuesta JSON con el TipoVehiculo creado y un código de estado 201 (Creado)
        return response()->json([
            'success' => true,
            'data' => $TipoVehiculo,
            'message' => 'TipoVehiculo creado con éxito',
        ], 201);
    }
    

    // Mostrar un TipoVehiculo específico
    public function show($id)
    {
        $TipoVehiculo = TipoVehiculo::find($id);

        if (!$TipoVehiculo) {
            return response()->json(['message' => 'TipoVehiculo no encontrado'], 404);
        }

        return response()->json($TipoVehiculo); // Devuelve el TipoVehiculo encontrado
    }

    // Actualizar un TipoVehiculo específico en la base de datos
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
        ]);

        $TipoVehiculo = TipoVehiculo::find($id);

        if (!$TipoVehiculo) {
            return response()->json(['message' => 'TipoVehiculo no encontrado'], 404);
        }

        $TipoVehiculo->update([
            'nombre' => $request->input('nombre'),
        ]);

        return response()->json($TipoVehiculo); // Devuelve el TipoVehiculo actualizado
    }

    // Eliminar un TipoVehiculo específico de la base de datos
    public function destroy($id)
    {
        $TipoVehiculo = TipoVehiculo::find($id);

        if (!$TipoVehiculo) {
            return response()->json(['message' => 'TipoVehiculo no encontrado'], 404);
        }

        $TipoVehiculo->delete();

        return response()->json(['message' => 'TipoVehiculo eliminado'], 200); // Devuelve un mensaje de éxito
    }
}
