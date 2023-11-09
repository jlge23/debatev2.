<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    protected $fillable = ['nombre','descripcion','fecha','status'];
    //Relacion 1:n - Juegos
    public function juegos(){
        return $this->hasMany(Juego::class);
    }
}
