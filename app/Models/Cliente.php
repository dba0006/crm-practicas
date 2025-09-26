<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Modelo Cliente - Entidad central del CRM
 * 
 * @property int $id
 * @property string $nombre
 * @property string $email
 * @property string|null $telefono
 * @property string|null $direccion
 */
class Cliente extends Model
{
    // Configuración para reutilización de IDs
    public $incrementing = false;
    protected $keyType = 'int';

    protected $fillable = [
        'id', 'nombre', 'email', 'telefono', 'direccion'
    ];

    /**
     * Formateo automático de teléfono español: +34 XXX XXX XXX
     */
    public function setTelefonoAttribute($value): void
    {
        if (empty($value)) {
            $this->attributes['telefono'] = null;
            return;
        }

        $cleaned = preg_replace('/[\s\-\(\)\+]/', '', $value);
        
        if (substr($cleaned, 0, 2) === '34' && strlen($cleaned) > 9) {
            $cleaned = substr($cleaned, 2);
        }
        
        if (preg_match('/^\d{9}$/', $cleaned)) {
            $formatted = '+34 ' . substr($cleaned, 0, 3) . ' ' . substr($cleaned, 3, 3) . ' ' . substr($cleaned, 6, 3);
            $this->attributes['telefono'] = $formatted;
        } else {
            $this->attributes['telefono'] = $value;
        }
    }

    /**
     * Encuentra el menor ID disponible (reutiliza IDs de registros eliminados)
     */
    public static function getNextAvailableId(): int
    {
        $usedIds = static::pluck('id')->sort()->values()->toArray();
        
        if (empty($usedIds)) return 1;
        
        for ($i = 1; $i <= max($usedIds); $i++) {
            if (!in_array($i, $usedIds)) return $i;
        }
        
        return max($usedIds) + 1;
    }

    /**
     * Asigna automáticamente el siguiente ID disponible al crear
     */
    protected static function boot()
    {
        parent::boot();
        static::creating(fn($model) => $model->id ??= static::getNextAvailableId());
    }

    public function incidencias(): HasMany
    {
        return $this->hasMany(Incidencia::class);
    }

    public function facturas(): HasMany
    {
        return $this->hasMany(Factura::class);
    }
}
