<?php

namespace App\Http\Controllers;

use App\Models\Marca;
use App\Http\Requests\StoreMarcaRequest;
use App\Http\Requests\UpdateMarcaRequest;
use Illuminate\Http\Request;

class MarcaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Marcas = Marca::all();
        return response()->json($Marcas);
    }

    // Almacenar un nuevo rol en la base de datos
    public function store(Request $request)
    {
        // Validación de los datos recibidos en la solicitud
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255',
        ]);
    
        // Creación del nuevo rol con los datos validados
        $Marca = Marca::create([
            'nombre' => $validatedData['nombre'],
        ]);
    
        // Respuesta JSON con el Marca creado y un código de estado 201 (Creado)
        return response()->json([
            'success' => true,
            'data' => $Marca,
            'message' => 'Marca creado con éxito',
        ], 201);
    }
    

    // Mostrar un Marca específico
    public function show($id)
    {
        $Marca = Marca::find($id);

        if (!$Marca) {
            return response()->json(['message' => 'Marca no encontrado'], 404);
        }

        return response()->json($Marca); // Devuelve el Marca encontrado
    }

    // Actualizar un Marca específico en la base de datos
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
        ]);

        $Marca = Marca::find($id);

        if (!$Marca) {
            return response()->json(['message' => 'Marca no encontrado'], 404);
        }

        $Marca->update([
            'nombre' => $request->input('nombre'),
        ]);

        return response()->json($Marca); // Devuelve el Marca actualizado
    }

    // Eliminar un Marca específico de la base de datos
    public function destroy($id)
    {
        $Marca = Marca::find($id);

        if (!$Marca) {
            return response()->json(['message' => 'Marca no encontrado'], 404);
        }

        $Marca->delete();

        return response()->json(['message' => 'Marca eliminado'], 200); // Devuelve un mensaje de éxito
    }
}
