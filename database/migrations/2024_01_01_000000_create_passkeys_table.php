<?php

use Illuminate\Database\Migrations\Migration;

/**
 * Sin efecto: los passkeys están desactivados (ver config/fortify.php) y los
 * usuarios viven en core.usuarios. Este archivo del starter kit puede eliminarse.
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
