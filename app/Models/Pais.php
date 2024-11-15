<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pais extends Model
{
    use HasFactory;

    protected $table = 'pais'; // Nombre de la tabla

    protected $fillable = [
        'nombre',
    ];

    public $timestamps = true;

    // Relación con ciudades: Un país tiene muchas ciudades
    public function ciudades()
    {
        return $this->hasMany(Ciudad::class, 'pais_id');
    }
}
