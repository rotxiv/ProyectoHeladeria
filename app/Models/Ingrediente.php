<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingrediente extends Model
{
    use HasFactory;

    protected $table = 'ingredientes';
    protected $primaryKey = 'id';
    public $incrementing = true; // Asegurar autoincremento
    protected $keyType = 'integer';
    protected $fillable = ['item_id', 'observacion', 'visible'];

    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
