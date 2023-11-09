<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ImportDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        //carga de preguntas y respuestas demo
        $preguntas = 'database/sql/preguntas_demo.sql';
        $respuestas = 'database/sql/respuestas_demo.sql';
        DB::unprepared(file_get_contents($preguntas));
        DB::unprepared(file_get_contents($respuestas));
        //carga de preguntas y respuestas del debate
        $preguntas = 'database/sql/preguntas_hechos.sql';
        $respuestas = 'database/sql/respuestas_hechos.sql';
        DB::unprepared(file_get_contents($preguntas));
        DB::unprepared(file_get_contents($respuestas));
    }
}
