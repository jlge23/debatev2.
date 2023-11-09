<?php

namespace Database\Seeders;

use App\Models\Dificultade;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DificultadeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Dificultade::create(['dificultad' => 'FÁCIL','puntaje' => 5,'tiempo' => 10,'status' => 1]);
        Dificultade::create(['dificultad' => 'MODERADA','puntaje' => 10,'tiempo' => 15,'status' => 1]);
        Dificultade::create(['dificultad' => 'DIFICIL','puntaje' => 15,'tiempo' => 20,'status' => 1]);
        Dificultade::create(['dificultad' => 'COMODÍN','puntaje' => 20,'tiempo' => 10,'status' => 1]);
    }
}
