<?php

use Illuminate\Database\Migrations\Migration;

/**
 * Sin efecto: los usuarios viven en core.usuarios y la autenticación de dos
 * factores está desactivada (ver config/fortify.php). Este archivo del starter
 * kit puede eliminarse.
 */
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        //
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
