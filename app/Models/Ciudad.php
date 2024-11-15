<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ciudad extends Model
{
    use HasFactory;

    protected $table = 'ciudad'; // Nombre de la tabla

    protected $fillable = [
        'nombre',
        'pais_id', // Clave foránea
    ];

    public $timestamps = true;

    // Relación con país: Una ciudad pertenece a un país
    public function pais()
    {
        return $this->belongsTo(Pais::class, 'pais_id');
    }

    // Relación con usuario: Una ciudad tiene muchos usuarios (opcional si es necesario)
    public function usuarios()
    {
        return $this->hasMany(Usuario::class, 'ciudad_id');
    }
}
