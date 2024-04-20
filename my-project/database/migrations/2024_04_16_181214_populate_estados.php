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
        DB::table('estados')->insert(
            array(
                ['nome' => 'Acre','uf' => 'AC'],
                ['nome' => 'Alagoas','uf' => 'AL'],
                ['nome' => 'Amapá','uf' => 'AP'],
                ['nome' => 'Amazonas','uf' => 'AM'],
                ['nome' => 'Bahia','uf' => 'BA'],
                ['nome' => 'Ceará','uf' => 'CE'],
                ['nome' => 'Espírito Santo','uf' => 'ES'],
                ['nome' => 'Goiás','uf' => 'GO'],
                ['nome' => 'Maranhão','uf' => 'MA'],
                ['nome' => 'Mato Grosso','uf' => 'MT'],
                ['nome' => 'Mato Grosso do Sul','uf' => 'MS'],
                ['nome' => 'Minas Gerais','uf' => 'MG'],
                ['nome' => 'Pará','uf' => 'PA'],
                ['nome' => 'Paraíba','uf' => 'PB'],
                ['nome' => 'Paraná','uf' => 'PR'],
                ['nome' => 'Pernambuco','uf' => 'PE'],
                ['nome' => 'Piauí','uf' => 'PI'],
                ['nome' => 'Rio de Janeiro','uf' => 'RJ'],
                ['nome' => 'Rio Grande do Norte','uf' => 'RN'],
                ['nome' => 'Rio Grande do Sul','uf' => 'RS'],
                ['nome' => 'Rondônia','uf' => 'RO'],
                ['nome' => 'Roraima','uf' => 'RR'],
                ['nome' => 'Santa Catarina','uf' => 'SC'],
                ['nome' => 'São Paulo','uf' => 'SP'],
                ['nome' => 'Sergipe','uf' => 'SE'],
                ['nome' => 'Tocantins','uf' => 'TO'],
                ['nome' => 'Distrito Federal','uf' => 'DF'],
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
