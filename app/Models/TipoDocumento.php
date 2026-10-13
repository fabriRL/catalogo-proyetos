<?php

namespace App\Models;

class TipoDocumento extends ModeloCatalogo
{
    protected $table = 'core.tipos_documento';

    protected $primaryKey = 'id_tipo_documento';
}
