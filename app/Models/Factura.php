<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Modelo Factura - Gestión financiera del CRM
 * 
 * @property int $id
 * @property int $cliente_id
 * @property string $numero
 * @property string $descripcion
 * @property float $monto
 * @property float $impuesto
 * @property float $total
 * @property \Carbon\Carbon $fecha
 * @property string $estado_pago
 */
class Factura extends Model
{
    public $incrementing = false;
    protected $keyType = 'int';

    protected $fillable = [
        'id', 'cliente_id', 'numero', 'descripcion', 'monto', 'impuesto', 'total', 'fecha', 'estado_pago'
    ];

    protected $casts = [
        'fecha' => 'date',
        'monto' => 'decimal:2',
        'impuesto' => 'decimal:2',
        'total' => 'decimal:2',
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
        'pendiente' => 'Pendiente',
        'pagada' => 'Pagada',
        'vencida' => 'Vencida',
        'cancelada' => 'Cancelada'
    ];

    public function cliente(): BelongsTo
    {
        return $this->belongsTo(Cliente::class);
    }

    public function scopePendientes($query)
    {
        return $query->where('estado_pago', 'pendiente');
    }

    public function scopePagadas($query)
    {
        return $query->where('estado_pago', 'pagada');
    }

    public function getTotalFormateadoAttribute(): string
    {
        return '$' . number_format($this->total, 2);
    }
}