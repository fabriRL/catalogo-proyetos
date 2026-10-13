<?php

// Solo las reglas que usa la aplicación; el resto cae al inglés (APP_FALLBACK_LOCALE).
return [
    'confirmed' => 'La confirmación de :attribute no coincide.',
    'current_password' => 'La contraseña es incorrecta.',
    'email' => ':Attribute debe ser un correo electrónico válido.',
    'lowercase' => ':Attribute debe estar en minúsculas.',
    'max' => [
        'string' => ':Attribute no debe tener más de :max caracteres.',
    ],
    'min' => [
        'string' => ':Attribute debe tener al menos :min caracteres.',
    ],
    'password' => [
        'letters' => ':Attribute debe contener al menos una letra.',
        'mixed' => ':Attribute debe contener al menos una mayúscula y una minúscula.',
        'numbers' => ':Attribute debe contener al menos un número.',
        'symbols' => ':Attribute debe contener al menos un símbolo.',
        'uncompromised' => ':Attribute apareció en una filtración de datos. Elige otra.',
    ],
    'required' => 'El campo :attribute es obligatorio.',
    'string' => ':Attribute debe ser texto.',
    'unique' => 'Este :attribute ya está registrado.',

    'attributes' => [
        'nombre' => 'nombre',
        'email' => 'correo electrónico',
        'password' => 'contraseña',
        'current_password' => 'contraseña actual',
        'password_confirmation' => 'confirmación de contraseña',
    ],
];
