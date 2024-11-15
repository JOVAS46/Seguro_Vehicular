<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PolizaCobertura extends Model
{
    protected $table = 'poliza_cobertura';
    protected $fillable = [
        'poliza_id',
        'cobertura_id',
        'monto_cobertura',
        'estado'
    ];

    public function poliza()
    {
        return $this->belongsTo(Poliza::class);
    }

    public function cobertura()
    {
        return $this->belongsTo(Cobertura::class);
    }
}