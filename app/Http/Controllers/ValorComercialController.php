<?php

namespace App\Http\Controllers;

use App\Models\ValorComercial;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ValorComercialController extends Controller
{
    public function index()
    {
        $valoresComerciales = ValorComercial::with('vehiculo')->get();
        return response()->json($valoresComerciales);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'vehiculo_id' => 'required|exists:vehiculo,id',
            'valor_inicial' => 'required|numeric',
            'valor_actual' => 'required|numeric',
            'fecha_valor' => 'required|date',
            'tasa_depreciacion' => 'required|numeric',
            'anos_depreciacion' => 'required|integer',
        ]);

        $valorComercial = ValorComercial::create($validatedData);

        return response()->json([
            'success' => true,
            'data' => $valorComercial,
            'message' => 'Valor comercial creado con éxito',
        ], 201);
    }

    public function show($id)
    {
        try {
            $valorComercial = ValorComercial::with('vehiculo')->findOrFail($id);
            return response()->json($valorComercial);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Valor comercial no encontrado',
            ], 404);
        }
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'vehiculo_id' => 'sometimes|required|exists:vehiculo,id',
            'valor_inicial' => 'sometimes|required|numeric',
            'valor_actual' => 'sometimes|required|numeric',
            'fecha_valor' => 'sometimes|required|date',
            'tasa_depreciacion' => 'sometimes|required|numeric',
            'anos_depreciacion' => 'sometimes|required|integer',
        ]);

        $valorComercial = ValorComercial::findOrFail($id);
        $valorComercial->update($validatedData);

        return response()->json([
            'success' => true,
            'data' => $valorComercial,
            'message' => 'Valor comercial actualizado con éxito',
        ]);
    }

    public function destroy($id)
    {
        $valorComercial = ValorComercial::findOrFail($id);
        $valorComercial->delete();

        return response()->json([
            'success' => true,
            'message' => 'Valor comercial eliminado con éxito',
        ]);
    }
}
