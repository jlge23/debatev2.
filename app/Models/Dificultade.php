<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dificultade extends Model
{
    protected $fillable = ['dificultad','puntaje','tiempo','status'];
    //Relacion 1:n - Preguntas
    public function preguntas(){
        return $this->hasMany(Pregunta::class);
    }
}
