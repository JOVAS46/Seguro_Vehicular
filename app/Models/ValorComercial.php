<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ValorComercial extends Model
{
    use HasFactory;

    protected $table = 'valor_comercial';

    // Campos que pueden ser llenados
    protected $fillable = [
        'vehiculo_id',
        'valor_inicial',
        'valor_actual',
        'fecha_valor',
        'tasa_depreciacion',
        'anos_depreciacion'
    ];

    // Relación con la tabla Vehículo
    public function vehiculo()
    {
        return $this->belongsTo(Vehiculo::class, 'vehiculo_id');
    }

    // Relación con la tabla Depreciación
    public function depreciaciones()
    {
        return $this->hasMany(Depreciacion::class, 'valor_comercial_id');
    }
}
