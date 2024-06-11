<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    use HasFactory;

    protected $table = 'pets';

    protected $fillable = [
        'id', 
        'descricao', 
        'especie_id', 
        'idade_estimada', 
        'nome', 
        'estado_id',
        'cidade_id',
        'porte_id', 
        'raca_id', 
        'user_id', 
        'vacinas',
        'image',
        'genero',
        'castracao'
    ];

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

    public function cidades(){
        return $this->belongsTo(Cidade::class);
    }

    public function estados(){
        return $this->belongsTo(Estado::class);
    }
}
