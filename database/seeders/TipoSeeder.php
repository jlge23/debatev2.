<?php

namespace Database\Seeders;

use App\Models\Tipo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TipoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tipo::create(['nombre' => 'VERDADERO Y FALSO','opciones' => 1,'status' => 1]);
        Tipo::create(['nombre' => 'SELECCIÓN SIMPLE','opciones' => 4,'status' => 1]);
        Tipo::create(['nombre' => 'DESARROLLO','opciones' => 1,'status' => 1]);
    }
}
