<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pregunta extends Model
{
    protected $fillable = ['id','numero','pregunta','tipo_id','dificultade_id','demo','status'];

    //Relacion 1:n Respuestas
    public function respuestas(){
        return $this->hasMany(Respuesta::class);
    }

    //Relacion 1:n inversa - Puntajes
    public function tipo(){
        return $this->belongsTo(Tipo::class);
    }

    //Relacion 1:n inversa - Dificultades
    public function dificultad(){
        return $this->belongsTo(Dificultade::class,'dificultade_id','id');
    }
}
