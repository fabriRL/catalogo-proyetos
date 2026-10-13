<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;

/**
 * Tablas de catálogo con la forma codigo / nombre / descripcion / orden / activo.
 */
abstract class ModeloCatalogo extends ModeloCore
{
    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'activo' => 'boolean',
            'orden' => 'integer',
        ];
    }

    /**
     * @param  Builder<static>  $query
     */
    public function scopeActivos(Builder $query): void
    {
        $query->where('activo', true);
    }

    /**
     * @param  Builder<static>  $query
     */
    public function scopeOrdenados(Builder $query): void
    {
        $query->orderBy('orden')->orderBy('nombre');
    }
}
