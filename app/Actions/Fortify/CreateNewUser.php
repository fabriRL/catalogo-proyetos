<?php

namespace App\Actions\Fortify;

use App\Concerns\PasswordValidationRules;
use App\Concerns\ProfileValidationRules;
use App\Models\Rol;
use App\Models\Usuario;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules, ProfileValidationRules;

    /**
     * Registro inicial: solo se permite mientras no exista ningún usuario.
     * Ese primer usuario queda como superadmin protegido (trigger
     * trg_usuarios_primer_protegido). Los demás los crea un administrador.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): Usuario
    {
        if (Usuario::withTrashed()->exists()) {
            throw ValidationException::withMessages([
                'email' => __('El registro está cerrado. Solicita una cuenta a un administrador.'),
            ]);
        }

        Validator::make($input, [
            ...$this->profileRules(),
            'password' => $this->passwordRules(),
        ])->validate();

        return DB::transaction(function () use ($input) {
            $usuario = Usuario::create([
                'nombre' => $input['nombre'],
                'email' => $input['email'],
                'password' => $input['password'],
            ]);

            $superadmin = Rol::where('name', Rol::SUPERADMIN)->firstOrFail();
            $usuario->roles()->attach($superadmin->id_rol);

            return $usuario;
        });
    }
}
