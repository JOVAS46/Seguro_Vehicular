<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notificacion extends Model
{
    use HasFactory;
    protected $table = 'notificacion';

    protected $fillable = [
        'mensaje',
        'fechaEnvio',
        'fechaCreacion',
        'estado',
        'tipo_id',
        'usuario_id',
    ];

    public $timestamps = true;

    // Relación con el tipo de notificación
    public function tipoNotificacion()
    {
        return $this->belongsTo(TipoNotificacion::class, 'tipo_id');
    }

    // Relación con el usuario
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }
}
