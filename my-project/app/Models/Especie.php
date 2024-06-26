<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Especie extends Model
{
    use HasFactory;

    public function pets(){
        return $this->hasMany(Pet::class);
    }

    public function racas(){
        return $this->hasMany(Raca::class);
    }
}
