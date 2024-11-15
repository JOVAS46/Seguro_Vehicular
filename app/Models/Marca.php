<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marca extends Model
{
    use HasFactory;

    // Nombre de la tabla asociada
    protected $table = 'marca';  // Se debe usar el nombre en minúscula, ya que las tablas generalmente se nombran así

    // Columnas que se pueden asignar masivamente
    protected $fillable = [
        'nombre',
    ];

    // Indicar si la tabla tiene timestamps
    public $timestamps = true;

    /**
     * Relación uno a muchos con Vehiculo.
     * Una Marca tiene muchos Vehiculos.
     */
    public function vehiculos()
    {
        return $this->hasMany(Vehiculo::class, 'marca_id');
    }
}
