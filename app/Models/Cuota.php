<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cuota extends Model
{
    protected $table = 'cuota';
    protected $fillable = [
        'plan_pago_id',
        'numero_cuota',
        'monto_cuota',
        'estado_cuota',
        'fecha_vencimiento',
        'fecha_pago',
        'estado'
    ];

    public function planPago()
    {
        return $this->belongsTo(PlanPago::class);
    }

    public function pagos()
    {
        return $this->hasMany(Pago::class);
    }
}