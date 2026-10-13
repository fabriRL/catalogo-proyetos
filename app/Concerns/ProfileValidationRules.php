<?php

namespace App\Concerns;

use App\Models\Usuario;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Validation\Rule;

trait ProfileValidationRules
{
    /**
     * Get the validation rules used to validate user profiles.
     *
     * @return array<string, array<int, ValidationRule|array<mixed>|string>>
     */
    protected function profileRules(?int $userId = null): array
    {
        return [
            'nombre' => $this->nameRules(),
            'email' => $this->emailRules($userId),
        ];
    }

    /**
     * Get the validation rules used to validate user names.
     *
     * @return array<int, ValidationRule|array<mixed>|string>
     */
    protected function nameRules(): array
    {
        return ['required', 'string', 'max:150'];
    }

    /**
     * El índice único de core.usuarios es lower(email) entre los no eliminados.
     *
     * @return array<int, ValidationRule|array<mixed>|string>
     */
    protected function emailRules(?int $userId = null): array
    {
        $unico = Rule::unique(Usuario::class, 'email')->whereNull('eliminado_en');

        return [
            'required',
            'string',
            'email',
            'max:150',
            $userId === null ? $unico : $unico->ignore($userId, 'id_usuario'),
        ];
    }
}
