<?php

namespace App\Support;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

/**
 * Pasa a PostgreSQL quién hace la petición, para que los triggers de
 * auditoría (core.fn_usuario_actual / fn_registrar_auditoria) lo registren.
 */
class ContextoAuditoria
{
    public static function establecer(Request $request, ?int $idUsuario): void
    {
        DB::select(
            'select set_config(?, ?, false), set_config(?, ?, false), set_config(?, ?, false), set_config(?, ?, false), set_config(?, ?, false)',
            [
                'app.id_usuario', $idUsuario === null ? '' : (string) $idUsuario,
                'app.ip', (string) $request->ip(),
                'app.navegador', Str::limit((string) $request->userAgent(), 500, ''),
                'app.url', Str::limit($request->fullUrl(), 500, ''),
                'app.id_peticion', self::idPeticion($request),
            ],
        );
    }

    private static function idPeticion(Request $request): string
    {
        if (! $request->attributes->has('id_peticion')) {
            $request->attributes->set('id_peticion', (string) Str::uuid());
        }

        return $request->attributes->get('id_peticion');
    }
}
