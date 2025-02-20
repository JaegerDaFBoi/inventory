<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    public $timestamps = false;
    protected $table = 'usuarios';
    protected $primaryKey = 'id';

    protected $fillable = [
        'nombre',
        'correo_electronico',
    ];

    public function credencial()
    {
        return $this->hasOne(Credencial::class, 'id_usuario');
    }
}
