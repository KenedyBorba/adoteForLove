<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::table('portes')->insert(
            array(
                ['nome' => 'Pequeno'],
                ['nome' => 'Médio'],
                ['nome' => 'Grande'],
                ['nome' => 'Desconhecido'],
            )
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
