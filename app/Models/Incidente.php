<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Incidente extends Model
{
    protected $table = 'incidente';
    
    protected $fillable = [
        'poliza_id',
        'tipo_incidente_id',
        'fecha_incidente',
        'descripcion',
        'ubicacion',
        'monto_estimado',
        'estado',
        'cobertura_id',
        'usuario_registro_id',
        'maps_url',
        'imagen_1',
        'imagen_2',
        'imagen_3',
        'imagen_4',
        'descripcion_imagen',
        'fecha_reporte',
        'estado_reporte',
        'url_imagen',
        'oficial_cargo',
        'observacion'
    ];

    public function poliza()
    {
        return $this->belongsTo(Poliza::class);
    }

    public function tipoIncidente()
    {
        return $this->belongsTo(TipoIncidente::class);
    }

    public function cobertura()
    {
        return $this->belongsTo(Cobertura::class);
    }

    public function usuarioRegistro()
    {
        return $this->belongsTo(User::class, 'usuario_registro_id');
    }
}