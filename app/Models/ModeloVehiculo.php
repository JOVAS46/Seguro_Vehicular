<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModeloVehiculo extends Model
{
    use HasFactory;

    // Nombre de la tabla asociada
    protected $table = 'modelo_vehiculo';  // Se recomienda el uso de nombres de tabla en minúscula y sin espacios

    // Columnas que se pueden asignar masivamente
    protected $fillable = [
        'nombre',
    ];

    // Indicar si la tabla tiene timestamps
    public $timestamps = true;

    /**
     * Relación uno a muchos con Vehiculo.
     * Un ModeloVehiculo tiene muchos Vehiculos.
     */
    public function vehiculos()
    {
        return $this->hasMany(Vehiculo::class, 'modelo_id');
    }
}
