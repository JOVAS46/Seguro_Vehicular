<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlanPago extends Model
{
    protected $table = 'plan_pago';
    protected $fillable = [
        'poliza_id',
        'monto_total',
        'fecha_inicio',
        'fecha_fin',
        'saldo',
        'tipo_plan',
        'numero_cuotas',
        'estado',
        'usuario_registro_id'
    ];

    public function poliza()
    {
        return $this->belongsTo(Poliza::class);
    }

    public function usuarioRegistro()
    {
        return $this->belongsTo(User::class, 'usuario_registro_id');
    }

    public function cuotas()
    {
        return $this->hasMany(Cuota::class);
    }
}