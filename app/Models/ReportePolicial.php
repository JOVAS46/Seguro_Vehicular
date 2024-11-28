<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReportePolicial extends Model
{
    protected $table = 'reporte_policial';
    protected $fillable = [
        'incidente_id',
        'numero_reporte',
        'fecha_reporte',
        'descripcion',
        'ubicacion',
        'oficial_cargo',
        'estado',
        'url_imagen',
        'usuario_registro_id'
    ];

    public function incidente()
    {
        return $this->belongsTo(Incidente::class);
    }

    public function usuarioRegistro()
    {
        return $this->belongsTo(User::class, 'usuario_registro_id');
    }
}
