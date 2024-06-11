<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if(!User::where('name','Ben')->first()){
            User::create([
                'name' => 'Ben',
                'email' => 'ben10@gmail.com',
                'telefone' => '51986184375',
                'data_nascimento' => '2000-08-20',
                'password' => Hash::make('12345678'),
            ]);
        }
        if(!User::where('name','Jorge')->first()){
            User::create([
                'name' => 'Jorge',
                'email' => 'jorge@gmail.com',
                'telefone' => '51996184311',
                'data_nascimento' => '2000-08-20',
                'password' => Hash::make('12345678'),
            ]);
        }
        if(!User::where('name','João')->first()){
            User::create([
                'name' => 'João',
                'email' => 'joao@gmail.com',
                'telefone' => '51996185666',
                'data_nascimento' => '2000-02-08',
                'password' => Hash::make('12345678'),
            ]);
        }
        if(!User::where('name','Cesar')->first()){
            User::create([
                'name' => 'Cesar',
                'email' => 'cesar@gmail.com',
                'telefone' => '51991516138',
                'data_nascimento' => '1988-03-01',
                'password' => Hash::make('12345678'),
            ]);
        }
    }
}
