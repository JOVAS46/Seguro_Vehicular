<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ComprobantePago extends Model
{
    protected $table = 'comprobante_pago';
    protected $fillable = [
        'pago_id',
        'numero_comprobante',
        'fecha_emision',
        'monto_total',
        'detalles_json',
        'estado'
    ];

    public function pago()
    {
        return $this->belongsTo(Pago::class);
    }
}