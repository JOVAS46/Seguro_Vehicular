<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehiculo extends Model
{
    use HasFactory;

    protected $table = 'vehiculo';  // Especifica la tabla

    protected $fillable = [
        'anio',
        'placa',
        'kilometraje',
        'fecha_adquisicion',
        'url_imagen',
        'url_documento', 
        'marca_id',
        'modelo_id',
        'tipoVehiculo_id',
        'propietario_id'
    ];

    // Relación con la marca
    public function marca()
    {
        return $this->belongsTo(Marca::class, 'marca_id');
    }

    // Relación con el modelo de vehículo
    public function modelo()
    {
        return $this->belongsTo(ModeloVehiculo::class, 'modelo_id');
    }

    // Relación con el tipo de vehículo
    public function tipoVehiculo()
    {
        return $this->belongsTo(TipoVehiculo::class, 'tipoVehiculo_id');
    }

    // Relación con el propietario (usuario)
    public function propietario()
    {
        return $this->belongsTo(Usuario::class, 'propietario_id');
    }
}
