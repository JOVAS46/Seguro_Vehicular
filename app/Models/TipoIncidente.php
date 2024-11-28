<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoIncidente extends Model
{
    protected $table = 'tipo_incidente';
    protected $fillable = ['nombre', 'descripcion', 'estado'];

    public function incidentes()
    {
        return $this->hasMany(Incidente::class);
    }
}
