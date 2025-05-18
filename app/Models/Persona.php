<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    use HasFactory;
    
    protected $table = 'personas';
    protected $primaryKey = 'id';
    public $incrementing = true; // Asegurar autoincremento    
    protected $keyType = 'integer';
    protected $fillable = ['carnet', 'nombre', 'telefono'];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cliente_id');
    }
}
