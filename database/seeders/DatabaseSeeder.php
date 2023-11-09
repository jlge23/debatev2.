<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(EventoSeeder::class);
        $this->call(EquiposSeeder::class);
        $this->call(TipoSeeder::class);
        $this->call(DificultadeSeeder::class);
        $this->call(ImportDataSeeder::class);
        $this->call(AdminUserSeeder::class);
    }
}
