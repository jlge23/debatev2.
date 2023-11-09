<?php

namespace Database\Seeders;

use App\Models\Equipo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EquiposSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Equipo::create(['nombre' => 'Equipo 1','descripcion' => 'Descripción del Equipo 1','status' => 1]);
        Equipo::create(['nombre' => 'Equipo 2','descripcion' => 'Descripción del Equipo 2','status' => 1]);
        Equipo::create(['nombre' => 'Equipo 3','descripcion' => 'Descripción del Equipo 3','status' => 1]);
        Equipo::create(['nombre' => 'Equipo 4','descripcion' => 'Descripción del Equipo 4','status' => 1]);
    }
}
