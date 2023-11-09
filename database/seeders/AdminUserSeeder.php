<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@debatev2.lan',
            'password' => Hash::make('admin')
        ]);
        DB::table('users')->insert([
            'name' => 'Jurado',
            'email' => 'jurado@debatev2.lan',
            'password' => Hash::make('jurado')
        ]);
    }
}
