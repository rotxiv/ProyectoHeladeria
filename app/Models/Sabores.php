<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sabores extends Model
{
    protected $table = 'sabores';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'integer';
    protected $fillable = ['codigo', 'descripcion', 'visible'];
}
