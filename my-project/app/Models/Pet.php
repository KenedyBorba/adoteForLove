<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    use HasFactory;

    public function users(){
        return $this->belongsTo(User::class);
    }

    public function especies(){
        return $this->belongsTo(Especie::class);
    }

    public function portes(){
        return $this->belongsTo(Porte::class);
    }

    public function racas(){
        return $this->belongsTo(Raca::class);
    }

    public function enderecos(){
        return $this->belongsTo(Endereco::class);
    }
}
