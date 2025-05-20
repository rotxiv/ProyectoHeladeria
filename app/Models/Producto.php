<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table = 'productos';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'integer';
    protected $fillable = [
        'item_id', 
        'nombre', 
        'tipo_id', 
        'sabor_id', 
        'observacion', 
        'visible'
    ];
}
