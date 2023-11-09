<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipo extends Model
{
    //use HasFactory;
    protected $fillable = ['nombre','descripcion','status'];

    //Relacion 1:n - Juegos
    public function juegos(){
        return $this->hasMany(Juego::class);
    }
}
