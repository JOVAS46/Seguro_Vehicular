<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Depreciacion extends Model
{
    use HasFactory;

    protected $table = 'depreciacion';

    // Campos que pueden ser llenados
    protected $fillable = [
        'valor_comercial_id',
        'valor_inicial',
        'valor_depreciado',
        'fecha_depreciacion',
        'motivo_depreciacion'
    ];

    // Relación con la tabla Valor Comercial
    public function valorComercial()
    {
        return $this->belongsTo(ValorComercial::class, 'valor_comercial_id');
    }
}
