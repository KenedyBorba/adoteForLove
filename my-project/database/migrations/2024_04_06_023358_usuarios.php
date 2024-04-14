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
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id();
            $table->string('nome')->nullable();
            $table->integer('idade')->unique();
            $table->string('email')->unique();
            $table->string('telefone')->unique();
            $table->foreignIdFor(\App\Models\Endereco::class);
            $table->foreignIdFor(\App\Models\Pet::class);
            $table->string('senha')->nullable();
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