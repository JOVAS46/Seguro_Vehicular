<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cita extends Model
{
    use HasFactory;
    protected $table = 'cita';

    protected $fillable = [
        'fecha',
        'duracion',
        'motivo',
        'estado',
        'fechaCreacion',
        'solicitante_id',
        'recepcion_id',
        'tipoCita_id',
    ];

    public $timestamps = true;

    // Relación con el solicitante (usuario)
    public function solicitante()
    {
        return $this->belongsTo(Usuario::class, 'solicitante_id');
    }

    // Relación con el recepcionista (usuario)
    public function recepcion()
    {
        return $this->belongsTo(Usuario::class, 'recepcion_id');
    }

    // Relación con el tipo de cita
    public function tipoCita()
    {
        return $this->belongsTo(TipoCita::class, 'tipoCita_id');
    }
}
