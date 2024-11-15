<?php

namespace App\Http\Controllers;

use App\Models\Vehiculo;
use Illuminate\Http\Request;

class VehiculoController extends Controller
{
    // Mostrar todos los vehículos
    public function index()
    {
        $vehiculos = Vehiculo::with(['marca', 'modelo', 'tipoVehiculo', 'propietario'])->get();
        return response()->json($vehiculos);
    }

    // Crear un nuevo vehículo
    public function store(Request $request)
    {
        // Validar los datos recibidos
        $validatedData = $request->validate([
            'anio' => 'required|integer',
            'placa' => 'required|string|max:20',
            'kilometraje' => 'required|integer',
            'fecha_adquisicion' => 'required|date',
            'url_imagen' => 'nullable|url',
            'url_documento' => 'nullable|url', 
            'marca_id' => 'required|exists:marca,id',
            'modelo_id' => 'required|exists:modelo_vehiculo,id',
            'tipoVehiculo_id' => 'required|exists:tipo_vehiculo,id',
            'propietario_id' => 'required|exists:usuario,id',
        ]);

        // Crear un nuevo vehículo
        $vehiculo = Vehiculo::create($validatedData);

        return response()->json([
            'success' => true,
            'data' => $vehiculo,
            'message' => 'Vehículo creado con éxito',
        ], 201);
    }

    // Mostrar un vehículo específico
    public function show($id)
    {
        $vehiculo = Vehiculo::with(['marca', 'modelo', 'tipoVehiculo', 'propietario'])->find($id);

        if (!$vehiculo) {
            return response()->json([
                'success' => false,
                'message' => 'Vehículo no encontrado',
            ], 404);
        }

        return response()->json($vehiculo);
    }

    // Actualizar un vehículo
    public function update(Request $request, $id)
    {
        // Validar los datos recibidos
        $validatedData = $request->validate([
            'anio' => 'required|integer',
            'placa' => 'required|string|max:20',
            'kilometraje' => 'required|integer',
            'fecha_adquisicion' => 'required|date',
            'url_imagen' => 'nullable|url',
            'marca_id' => 'required|exists:marca,id',
            'modelo_id' => 'required|exists:modelo_vehiculo,id',
            'tipoVehiculo_id' => 'required|exists:tipo_vehiculo,id',
            'propietario_id' => 'required|exists:usuario,id',
        ]);

        // Buscar el vehículo
        $vehiculo = Vehiculo::find($id);

        if (!$vehiculo) {
            return response()->json([
                'success' => false,
                'message' => 'Vehículo no encontrado',
            ], 404);
        }

        // Actualizar el vehículo
        $vehiculo->update($validatedData);

        return response()->json([
            'success' => true,
            'data' => $vehiculo,
            'message' => 'Vehículo actualizado con éxito',
        ]);
    }

    // Eliminar un vehículo
    public function destroy($id)
    {
        $vehiculo = Vehiculo::find($id);

        if (!$vehiculo) {
            return response()->json([
                'success' => false,
                'message' => 'Vehículo no encontrado',
            ], 404);
        }

        $vehiculo->delete();

        return response()->json([
            'success' => true,
            'message' => 'Vehículo eliminado con éxito',
        ]);
    }
}
