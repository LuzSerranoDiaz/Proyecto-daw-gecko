<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class comments extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('comments')->insert([
            'title' => 'Comentario 1',
            'desc' => 'Porfa apruebame',
            'tasks_id' => 78,
        ]);
        DB::table('comments')->insert([
            'title' => 'Comentario 2',
            'desc' => 'Comentario 2',
            'tasks_id' => 78,
        ]);
        DB::table('comments')->insert([
            'title' => 'Comentario 3',
            'desc' => 'Comentario 3',
            'tasks_id' => 78,
        ]);
    }
}
