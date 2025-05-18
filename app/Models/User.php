<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    protected $table = "users";
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'empleado_id',
        'name',
        'email',
        'password',
        'visible',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'empleado_id');
    }
    public function rol()
    {
        return $this->belongsToMany(Rol::class, 'user_rol')
                ->orderByDesc('fecha_asignacion')
                ->first(); // Devuelve solo el rol más reciente
    }
    public function rolActual()
    {
        return $this->roles()->orderByDesc('fecha_asignacion')->first();
    }

    public function roles()
    {
        return $this->belongsToMany(Rol::class, 'user_rol')
                    ->withPivot('fecha_asignacion') // Incluye la fecha de asignación
                    ->withTimestamps();
    }

    public function rolActivo()
    {
        return $this->roles()->wherePivot('activo', true)->first();
    }

}
