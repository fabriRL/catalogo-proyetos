<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Base para las tablas del esquema "core".
 *
 * Todas comparten columnas de auditoría (creado/actualizado/eliminado en/por)
 * y borrado lógico. Los triggers de la base completan los campos "*_por"
 * a partir de app.id_usuario (ver App\Support\ContextoAuditoria).
 */
abstract class ModeloCore extends Model
{
    use SoftDeletes;

    public const CREATED_AT = 'creado_en';

    public const UPDATED_AT = 'actualizado_en';

    public const DELETED_AT = 'eliminado_en';

    /**
     * @var list<string>
     */
    protected $guarded = [
        'creado_en',
        'actualizado_en',
        'eliminado_en',
        'creado_por',
        'actualizado_por',
        'eliminado_por',
    ];

    /**
     * @var list<string>
     */
    protected $hidden = [
        'creado_por',
        'actualizado_por',
        'eliminado_en',
        'eliminado_por',
    ];
}
