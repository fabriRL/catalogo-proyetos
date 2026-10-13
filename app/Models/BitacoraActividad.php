<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Bitácora de eventos de acceso (core.bitacora_actividad). Solo inserción:
 * la base rechaza UPDATE y DELETE.
 */
class BitacoraActividad extends Model
{
    public const CREATED_AT = 'creado_en';

    public const UPDATED_AT = null;

    protected $table = 'core.bitacora_actividad';

    protected $primaryKey = 'id_bitacora';

    /**
     * @var list<string>
     */
    protected $guarded = ['id_bitacora', 'creado_en'];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'datos_extra' => 'array',
            'creado_en' => 'datetime',
        ];
    }
}
