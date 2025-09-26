<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Modelo Incidencia - Tickets de soporte del CRM
 * 
 * @property int $id
 * @property int $cliente_id
 * @property string $titulo
 * @property string $descripcion
 * @property string $prioridad
 * @property string $estado
 * @property \Carbon\Carbon $fecha
 */
class Incidencia extends Model
{
    public $incrementing = false;
    protected $keyType = 'int';
    protected $fillable = [
        'id', 'cliente_id', 'titulo', 'descripcion', 'prioridad', 'estado', 'fecha'
    ];

    protected $casts = [
        'fecha' => 'date',
    ];

    public static function getNextAvailableId(): int
    {
        $usedIds = static::pluck('id')->sort()->values()->toArray();
        
        if (empty($usedIds)) return 1;
        
        for ($i = 1; $i <= max($usedIds); $i++) {
            if (!in_array($i, $usedIds)) return $i;
        }
        
        return max($usedIds) + 1;
    }

    protected static function boot()
    {
        parent::boot();
        static::creating(fn($model) => $model->id ??= static::getNextAvailableId());
    }

    public const ESTADOS = [
        'abierta' => 'Abierta',
        'en_proceso' => 'En Proceso',
        'resuelta' => 'Resuelta',
        'cerrada' => 'Cerrada'
    ];

    public function cliente(): BelongsTo
    {
        return $this->belongsTo(Cliente::class);
    }

    public function scopeAbiertas($query)
    {
        return $query->whereIn('estado', ['abierta', 'en_proceso']);
    }
}
