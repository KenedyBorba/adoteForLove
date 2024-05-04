<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Endereco extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'logradouro',
        'numero',
        'bairro',
        'estado_id',
        'cidade_id',
    ];

    public function users(){
        return $this->hasMany(User::class);
    }

    public function cidades(){
        return $this->belongsTo(Cidade::class);
    }

    public function estados(){
        return $this->belongsTo(Estado::class);
    }
}
