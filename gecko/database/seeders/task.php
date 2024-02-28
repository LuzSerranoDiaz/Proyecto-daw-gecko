<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class task extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tasks')->insert([
            'title' => 'Bombardear olula',
            'desc' => 'descripcion',
            'color' => 1,
            'solved' => true,
            'position' => 1,
        ]);
        DB::table('tasks')->insert([
            'title' => 'Bombardear olula',
            'desc' => 'otra vez',
            'color' => 1,
            'solved' => false,
            'position' => 1,
        ]);
        DB::table('tasks')->insert([
            'title' => 'EjemploBorrar',
            'desc' => 'descripcion',
            'color' => 1,
            'solved' => true,
            'position' => 1,
        ]);
        DB::table('tasks')->insert([
            'title' => 'EjemploBorrar2',
            'desc' => 'otra vez',
            'color' => 1,
            'solved' => false,
            'position' => 1,
        ]);
    }
}
