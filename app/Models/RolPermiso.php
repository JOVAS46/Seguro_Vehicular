<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RolPermiso extends Model
{
    use HasFactory;
    protected $table = 'rol_permiso';

    public $timestamps = false;

    protected $fillable = [
        'permiso_id',
        'rol_id',
    ];
}
