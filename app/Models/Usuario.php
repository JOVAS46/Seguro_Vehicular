<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;

    // Nombre de la tabla
    protected $table = 'usuario';  // Cambié la tabla a 'usuario' (en minúsculas, como la convención)

    // Columnas que se pueden asignar masivamente
    protected $fillable = [
        'nombre',
        'apellido',
        'email',
        'contrasena',
        'estado',
        'ci',
        'celular',
        'direccion',
        'tipoUsuario_id',
        'rol_id',
        'pais_id',
        'ciudad_id',
        'user_id',  // Relación con users
    ];

    // Timestamps
    public $timestamps = true;

    // Relación con la tabla tipo_usuario
    public function tipoUsuario()
    {
        return $this->belongsTo(TipoUsuario::class, 'tipoUsuario_id');
    }

    // Relación con la tabla rol
    public function rol()
    {
        return $this->belongsTo(Rol::class, 'rol_id');
    }

    // Relación con la tabla pais
    public function pais()
    {
        return $this->belongsTo(Pais::class, 'pais_id');
    }

    // Relación con la tabla ciudad
    public function ciudad()
    {
        return $this->belongsTo(Ciudad::class, 'ciudad_id');
    }

    // Relación con la tabla users (debe estar en la misma tabla, user_id es el enlace)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
