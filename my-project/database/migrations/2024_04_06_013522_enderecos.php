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
        Schema::create('enderecos', function (Blueprint $table) {
            $table->id();
            $table->string('rua')->nullable();
            $table->integer('numero')->nullable();
            $table->string('bairro')->nullable();
            $table->foreignIdFor(\App\Models\Estado::class);
            $table->foreignIdFor(\App\Models\Cidade::class);
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
