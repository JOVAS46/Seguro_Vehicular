<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MetodoPago extends Model
{
    protected $table = 'metodo_pago';
    protected $fillable = ['nombre', 'descripcion', 'estado', 'configuracion_json'];

    public function pagos()
    {
        return $this->hasMany(Pago::class);
    }
}
