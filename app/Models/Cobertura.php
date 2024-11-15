<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cobertura extends Model
{
    protected $table = 'cobertura';
    protected $fillable = ['nombre', 'descripcion', 'monto_maximo', 'estado'];

    public function polizaCoberturas()
    {
        return $this->hasMany(PolizaCobertura::class);
    }

    public function incidentes()
    {
        return $this->hasMany(Incidente::class);
    }
}
