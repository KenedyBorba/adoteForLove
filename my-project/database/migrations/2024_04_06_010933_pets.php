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
            $table->string('image')->nullable();
            $table->string('nome');
            $table->integer('idade_estimada')->nullable();
            $table->string('vacinas')->nullable();
            $table->string('descricao')->nullable();
            $table->enum('genero', ['Macho', 'Fêmea'])->nullable();
            $table->enum('castracao', ['Sim', 'Não'])->nullable();
            $table->foreignIdFor(\App\Models\User::class);
            $table->foreignIdFor(\App\Models\Especie::class);
            $table->foreignIdFor(\App\Models\Porte::class);
            $table->foreignIdFor(\App\Models\Raca::class);
            $table->foreignIdFor(\App\Models\Cidade::class)->nullable();
            $table->foreignIdFor(\App\Models\Estado::class)->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
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
