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
            'title' => 'Bombardear olula',
            'desc' => 'descripcion',
            'tasks_id' => 4,
        ]);
        DB::table('comments')->insert([
            'title' => 'Bombardear olula',
            'desc' => 'descripcion',
            'tasks_id' => 4,
        ]);
        DB::table('comments')->insert([
            'title' => 'Bombardear olula',
            'desc' => 'descripcion',
            'tasks_id' => 4,
        ]);
    }
}
