<?php

namespace App\Http\Controllers;

use App\Models\ReportePolicial;
use Illuminate\Http\Request;

class ReportePolicialController extends Controller
{
    public function index()
    {
        $reportes = ReportePolicial::with(['incidente', 'usuarioRegistro'])->get();
        return response()->json([
            'success' => true,
            'data' => $reportes
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'incidente_id' => 'required|exists:incidente,id',
            'numero_reporte' => 'required|string',
            'fecha_reporte' => 'required|date',
            'descripcion' => 'required|string',
            'ubicacion' => 'required|string',
            'oficial_cargo' => 'required|string',
            'estado' => 'required|string',
            'url_imagen' => 'nullable|string',
            'usuario_registro_id' => 'required|exists:users,id'
        ]);

        $reporte = ReportePolicial::create($request->all());
        return response()->json([
            'success' => true,
            'message' => 'Reporte policial creado exitosamente',
            'data' => $reporte
        ], 201);
    }

    public function show($id)
    {
        $reporte = ReportePolicial::with(['incidente.poliza', 'usuarioRegistro'])->findOrFail($id);
        return response()->json([
            'success' => true,
            'data' => $reporte
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'incidente_id' => 'required|exists:incidente,id',
            'numero_reporte' => 'required|string',
            'fecha_reporte' => 'required|date',
            'descripcion' => 'required|string',
            'ubicacion' => 'required|string',
            'oficial_cargo' => 'required|string',
            'estado' => 'required|string',
            'url_imagen' => 'nullable|string',
            'usuario_registro_id' => 'required|exists:users,id'
        ]);

        $reporte = ReportePolicial::findOrFail($id);
        $reporte->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Reporte policial actualizado exitosamente',
            'data' => $reporte
        ]);
    }

    public function destroy($id)
    {
        $reporte = ReportePolicial::findOrFail($id);
        $reporte->delete();

        return response()->json([
            'success' => true,
            'message' => 'Reporte policial eliminado exitosamente'
        ]);
    }

    public function getReportesByIncidente($incidenteId)
    {
        $reportes = ReportePolicial::where('incidente_id', $incidenteId)
            ->with(['usuarioRegistro'])
            ->get();
            
        return response()->json([
            'success' => true,
            'data' => $reportes
        ]);
    }
}
