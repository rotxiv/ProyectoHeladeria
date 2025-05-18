<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    use HasFactory;

    protected $table = 'roles';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'integer';
    protected $fillable = ['nombre', 'descripcion', 'permisos', 'visible'];
    
    public function usuarios()
    {
        return $this->belongsToMany(User::class, 'usuario_rol')
                    ->withPivot('fecha_asignacion')
                    ->withTimestamps();
    }

    public function getPermisosAttribute($value)
    {
        return json_decode($value, true);
    }
}
