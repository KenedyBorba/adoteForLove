<?php

namespace Database\Seeders;

use App\Models\Pet;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if(!Pet::where('nome','mel')->first()){
            Pet::create([
                'nome' => 'mel',
                'descricao' => 'gata querida',
                'image' => 'img/pets/f65c33c995c9d0846939d55ca505716e.1716520136.jpg',
                'idade_estimada' => 1,
                'porte_id' => 1,
                'especie_id' => 2,
                'raca_id' => 274,
                'cidade_id' => 4625,
                'estado_id' => 20,
                'vacinas' => 'todas as vacinas feitas',
                'genero' => 'Fêmea',
                'castracao' => 'Sim',
                'user_id' => 1
            ]);
        }
        if(!Pet::where('nome','fermina')->first()){
            Pet::create([
                'nome' => 'fermina',
                'descricao' => 'brincalhona e ótima com crianças',
                'image' => 'img/pets/29e763c97b912ae25cb304e8d1270c8b.1715372868.png',
                'idade_estimada' => 3,
                'porte_id' => 1,
                'especie_id' => 1,
                'raca_id' => 217,
                'cidade_id' => 683,
                'estado_id' => 17,
                'vacinas' => 'nenhuma ainda',
                'genero' => 'Fêmea',
                'castracao' => 'Sim',
                'user_id' => 1
            ]);
        }
        if(!Pet::where('nome','valmor')->first()){
            Pet::create([
                'nome' => 'valmor',
                'descricao' => 'é um gato encantador e brincalhão que conquista a todos com sua personalidade cativante e seu olhar expressivo. Ele é de porte médio, com aproximadamente 4 kg',
                'image' => 'img/pets/0e1d1a299c01c112895794c095756de9.1717535639.jpg',
                'idade_estimada' => 1,
                'porte_id' => 3,
                'especie_id' => 2,
                'raca_id' => 274,
                'cidade_id' => 1481,
                'estado_id' => 16,
                'vacinas' => 'nenhuma ainda',
                'genero' => 'Macho',
                'castracao' => 'Não',
                'user_id' => 1
            ]);
        }
        if(!Pet::where('nome','pipoca')->first()){
            Pet::create([
                'nome' => 'pipoca',
                'descricao' => 'salsicha brincalhão',
                'image' => 'img/pets/83e792395aa18ae681abfe30380c05da.1716593923.jpg',
                'idade_estimada' => 1,
                'porte_id' => 1,
                'especie_id' => 1,
                'raca_id' => 79,
                'cidade_id' => 3195,
                'estado_id' => 18,
                'vacinas' => 'nenhuma ainda',
                'genero' => 'Macho',
                'castracao' => 'Não',
                'user_id' => 1
            ]);
        }
        if(!Pet::where('nome','amelia')->first()){
            Pet::create([
                'nome' => 'amelia',
                'descricao' => 'gata querida',
                'image' => 'img/pets/filhote-de-gato-cuidados.jpg',
                'idade_estimada' => 1,
                'porte_id' => 1,
                'especie_id' => 2,
                'raca_id' => 274,
                'cidade_id' => 3913,
                'estado_id' => 15,
                'vacinas' => 'todas as vacinas feitas',
                'genero' => 'Fêmea',
                'castracao' => 'Sim',
                'user_id' => 3
            ]);
        }
    }
}