<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Porte extends Model
{
    use HasFactory;

    protected $table = 'portes';

    protected $fillable = ['nome'];

    public function pets(){
        return $this->hasMany(Pet::class);
    }
    
}
