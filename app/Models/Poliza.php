<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Poliza extends Model
{
    protected $table = 'poliza';
    protected $fillable = [
        'numero_poliza',
        'vehiculo_id',
        'fecha_inicio',
        'fecha_fin',
        'monto_total',
        'prima_mensual',
        'estado',
        'documento_url',
        'usuario_registro_id'
    ];

    public function vehiculo()
    {
        return $this->belongsTo(Vehiculo::class);
    }

    public function usuarioRegistro()
    {
        return $this->belongsTo(User::class, 'usuario_registro_id');
    }

    public function planPagos()
    {
        return $this->hasMany(PlanPago::class);
    }

    public function polizaCoberturas()
    {
        return $this->hasMany(PolizaCobertura::class);
    }

    public function incidentes()
    {
        return $this->hasMany(Incidente::class);
    }
}