<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    protected $table = 'pago';
    protected $fillable = [
        'cuota_id',
        'metodo_pago_id',
        'motivo_pago_id',
        'usuario_registro_id',
        'fecha',
        'monto',
        'notas',
        'estado',
        'comprobante_pago'
    ];

    public function cuota()
    {
        return $this->belongsTo(Cuota::class);
    }

    public function metodoPago()
    {
        return $this->belongsTo(MetodoPago::class);
    }

    public function motivoPago()
    {
        return $this->belongsTo(MotivoPago::class);
    }

    public function usuarioRegistro()
    {
        return $this->belongsTo(User::class, 'usuario_registro_id');
    }

    public function comprobantePago()
    {
        return $this->hasOne(ComprobantePago::class);
    }
}