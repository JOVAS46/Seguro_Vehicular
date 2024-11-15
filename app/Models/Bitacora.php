<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bitacora extends Model
{
    use HasFactory;
    protected $table = 'bitacora';

    protected $fillable = [
        'usuario_id',
        'fechaHora',
        'accion',
        'detalles',
        'ip',
    ];

    public $timestamps = true;

    // Relación con la tabla usuario
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }
}
