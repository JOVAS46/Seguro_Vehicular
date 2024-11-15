<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Incidente extends Model
{
    protected $table = 'incidente';
    protected $fillable = [
        'poliza_id',
        'fecha_incidente',
        'descripcion',
        'ubicacion',
        'monto_estimado',
        'estado',
        'cobertura_id',
        'usuario_registro_id'
    ];

    public function poliza()
    {
        return $this->belongsTo(Poliza::class);
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
