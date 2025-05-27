<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bitacora extends Model
{
    public $timestamps = false;

    protected $table = 'bitacoras'; // <--- IMPORTANTE

    protected $fillable = [
        'user_id',
        'ip_address',
        'user_agent',
        'logged_in_at', // <-- para el inicio de sesión
        'logged_out_at' // <-- para el cierre de sesión
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
