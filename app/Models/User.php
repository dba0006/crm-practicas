<?php

namespace App\Models;

// Modelo User: representa a los usuarios del sistema.
// Incluye atributos básicos y configuración para autenticación.
// Puedes extender este modelo para agregar roles y permisos.
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * $fillable: atributos que se pueden asignar masivamente.
     * name: nombre del usuario
     * email: correo electrónico único
     * password: contraseña cifrada
     * role: rol del usuario (admin, user)
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    /**
     * $hidden: atributos ocultos al serializar el modelo (por seguridad).
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Aquí puedes definir los atributos que deben ser convertidos a tipos nativos.
     */

    /**
     * Verifica si el usuario tiene rol de administrador.
     * @return bool
     */
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    /**
     * Verifica si el usuario tiene rol de usuario normal.
     * @return bool
     */
    public function isUser(): bool
    {
        return $this->role === 'user';
    }
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
