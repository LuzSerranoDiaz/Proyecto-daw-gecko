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
            'title' => 'Tarea 1',
            'desc' => 'descripcion 1',
            'color' => 1,
            'solved' => false,
            'position' => 1,
        ]);
        DB::table('tasks')->insert([
            'title' => 'Tarea 2',
            'desc' => 'Descripcion 2',
            'color' => 2,
            'solved' => false,
            'position' => 1,
        ]);
        DB::table('tasks')->insert([
            'title' => 'Tarea 3',
            'desc' => 'descripcion 3',
            'color' => 3,
            'solved' => false,
            'position' => 1,
        ]);
        DB::table('tasks')->insert([
            'title' => 'Tarea 4',
            'desc' => 'descripcion 4',
            'color' => 2,
            'solved' => true,
            'position' => 1,
        ]);
        DB::table('tasks')->insert([
            'title' => 'Tarea 5',
            'desc' => 'descripcion 5',
            'color' => 1,
            'solved' => true,
            'position' => 1,
        ]);
    }
}
