<?php

namespace App\Models;

/**
 * Roles de acceso a la plataforma (core.roles, con la forma de spatie/laravel-permission).
 */
class Rol extends ModeloCore
{
    public const SUPERADMIN = 'superadmin';

    public const ADMINISTRADOR = 'administrador';

    public const RESPONSABLE = 'responsable';

    public const CONSULTA = 'consulta';

    protected $table = 'core.roles';

    protected $primaryKey = 'id_rol';
}
