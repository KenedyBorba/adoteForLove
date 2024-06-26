<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Raca extends Model
{
    use HasFactory;

    public function pets(){
        return $this->hasMany(Pet::class);
    }

    public function especies(){
        return $this->belongsTo(Especie::class);
    }
}
