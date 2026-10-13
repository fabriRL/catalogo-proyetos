<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

/**
 * Usuario de la plataforma (core.usuarios).
 *
 * La contraseña se guarda siempre hasheada (cast "hashed", bcrypt).
 * Los triggers de la base marcan como "protegido" al primer usuario e
 * impiden desactivarlo o eliminarlo.
 *
 * @property int $id_usuario
 * @property string $nombre
 * @property string $email
 * @property Carbon|null $email_verificado_en
 * @property string $password
 * @property string|null $remember_token
 * @property string|null $telefono
 * @property string|null $cargo
 * @property int|null $id_area
 * @property bool $activo
 * @property bool $protegido
 * @property Carbon|null $ultimo_acceso_en
 * @property string|null $ultima_ip
 * @property Carbon|null $creado_en
 * @property Carbon|null $actualizado_en
 */
class Usuario extends Authenticatable
{
    use Notifiable, SoftDeletes;

    public const CREATED_AT = 'creado_en';

    public const UPDATED_AT = 'actualizado_en';

    public const DELETED_AT = 'eliminado_en';

    protected $table = 'core.usuarios';

    protected $primaryKey = 'id_usuario';

    /**
     * @var list<string>
     */
    protected $fillable = [
        'nombre',
        'email',
        'password',
        'telefono',
        'cargo',
        'id_area',
        'activo',
    ];

    /**
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verificado_en' => 'datetime',
            'ultimo_acceso_en' => 'datetime',
            'password' => 'hashed',
            'activo' => 'boolean',
            'protegido' => 'boolean',
        ];
    }

    /**
     * El correo se guarda siempre en minúsculas (el índice único usa lower(email)).
     *
     * @return Attribute<string, string>
     */
    protected function email(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => Str::lower(trim($value)),
        );
    }

    /**
     * @return BelongsToMany<Rol, $this>
     */
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Rol::class, 'core.modelo_roles', 'id_modelo', 'id_rol')
            ->withPivotValue('model_type', self::class);
    }

    public function tieneRol(string ...$roles): bool
    {
        return $this->roles->pluck('name')->intersect($roles)->isNotEmpty();
    }
}
