<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    use HasFactory;
    protected $table = 'empleados';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'integer';
    protected $fillable = ['persona_id', 'direccion', 'visible'];

    public function persona()
    {
        return $this->belongsTo(Persona::class, 'persona_id');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'empleado_id');
    }

}
