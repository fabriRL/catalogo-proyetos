<?php

namespace App\Listeners;

use App\Models\BitacoraActividad;
use App\Models\Usuario;
use App\Support\ContextoAuditoria;
use Illuminate\Auth\Events\Failed;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

/**
 * Registra en core.bitacora_actividad los eventos de acceso.
 * Laravel descubre cada método handle* por el tipo de evento que recibe.
 */
class RegistrarActividadDeAcceso
{
    public function __construct(private Request $request) {}

    public function handleLogin(Login $event): void
    {
        /** @var Usuario $usuario */
        $usuario = $event->user;

        ContextoAuditoria::establecer($this->request, $usuario->id_usuario);

        $usuario->forceFill([
            'ultimo_acceso_en' => now(),
            'ultima_ip' => $this->request->ip(),
        ])->saveQuietly();

        $this->registrar('inicio_sesion', 'Inicio de sesión', $usuario);
    }

    public function handleLogout(Logout $event): void
    {
        if ($event->user instanceof Usuario) {
            $this->registrar('cierre_sesion', 'Cierre de sesión', $event->user);
        }
    }

    public function handleFailed(Failed $event): void
    {
        $email = Str::lower((string) ($event->credentials['email'] ?? ''));

        $this->registrar('inicio_sesion_fallido', 'Intento de inicio de sesión fallido', $event->user instanceof Usuario ? $event->user : null, $email);
    }

    public function handlePasswordReset(PasswordReset $event): void
    {
        if ($event->user instanceof Usuario) {
            $this->registrar('restablecer_contrasena', 'Contraseña restablecida', $event->user);
        }
    }

    private function registrar(string $evento, string $descripcion, ?Usuario $usuario, ?string $email = null): void
    {
        BitacoraActividad::create([
            'id_usuario' => $usuario?->id_usuario,
            'email_usuario' => $usuario->email ?? $email,
            'evento' => $evento,
            'descripcion' => $descripcion,
            'direccion_ip' => $this->request->ip(),
            'navegador' => $this->request->userAgent(),
            'url' => $this->request->fullUrl(),
        ]);
    }
}
