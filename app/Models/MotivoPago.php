<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MotivoPago extends Model
{
    protected $table = 'motivo_pago';
    protected $fillable = ['descripcion', 'estado'];

    public function pagos()
    {
        return $this->hasMany(Pago::class);
    }
}