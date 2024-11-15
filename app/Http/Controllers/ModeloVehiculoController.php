<?php

namespace App\Http\Controllers;

use App\Models\ModeloVehiculo;
use App\Http\Requests\StoreModeloVehiculoRequest;
use App\Http\Requests\UpdateModeloVehiculoRequest;
use Illuminate\Http\Request;

class ModeloVehiculoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ModelosVehiculos = ModeloVehiculo::all();
        return response()->json($ModelosVehiculos);
    }

    // Almacenar un nuevo rol en la base de datos
    public function store(Request $request)
    {
        // Validación de los datos recibidos en la solicitud
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255',
        ]);
    
        // Creación del nuevo rol con los datos validados
        $ModeloVehiculo = ModeloVehiculo::create([
            'nombre' => $validatedData['nombre'],
        ]);
    
        // Respuesta JSON con el ModeloVehiculo creado y un código de estado 201 (Creado)
        return response()->json([
            'success' => true,
            'data' => $ModeloVehiculo,
            'message' => 'ModeloVehiculo creado con éxito',
        ], 201);
    }
    

    // Mostrar un ModeloVehiculo específico
    public function show($id)
    {
        $ModeloVehiculo = ModeloVehiculo::find($id);

        if (!$ModeloVehiculo) {
            return response()->json(['message' => 'ModeloVehiculo no encontrado'], 404);
        }

        return response()->json($ModeloVehiculo); // Devuelve el ModeloVehiculo encontrado
    }

    // Actualizar un ModeloVehiculo específico en la base de datos
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
        ]);

        $ModeloVehiculo = ModeloVehiculo::find($id);

        if (!$ModeloVehiculo) {
            return response()->json(['message' => 'ModeloVehiculo no encontrado'], 404);
        }

        $ModeloVehiculo->update([
            'nombre' => $request->input('nombre'),
        ]);

        return response()->json($ModeloVehiculo); // Devuelve el ModeloVehiculo actualizado
    }

    // Eliminar un ModeloVehiculo específico de la base de datos
    public function destroy($id)
    {
        $ModeloVehiculo = ModeloVehiculo::find($id);

        if (!$ModeloVehiculo) {
            return response()->json(['message' => 'ModeloVehiculo no encontrado'], 404);
        }

        $ModeloVehiculo->delete();

        return response()->json(['message' => 'ModeloVehiculo eliminado'], 200); // Devuelve un mensaje de éxito
    }
}
