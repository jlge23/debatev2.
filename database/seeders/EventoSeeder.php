<?php

namespace Database\Seeders;

use App\Models\Evento;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EventoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //['nombre','descripcion','fecha','status','iglesia_id'];
        Evento::create(['id' => 1,'nombre' => 'Debate Bíblico Congregacional','descripcion' => 'La Trinidad de Dios','fecha' => '2023-07-15','status' => 1]);
    }
}
