<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pets', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\User::class);
            $table->string('nome');
            $table->integer('idadeEstimada')->nullable();
            $table->boolean('vacinas')->nullable();
            $table->foreignIdFor(\App\Models\Especie::class);
            $table->foreignIdFor(\App\Models\Porte::class);
            $table->foreignIdFor(\App\Models\Raca::class);
            $table->foreignIdFor(\App\Models\Endereco::class);
            $table->string('descricao')->nullable();
            $table->timestamp('criado_em')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
