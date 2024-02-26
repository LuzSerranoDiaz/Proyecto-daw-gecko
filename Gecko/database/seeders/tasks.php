<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class tasks extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('task')->insert([
            'title' => 'Bombardear olula',
            'desc' => 'descripcion',
            'color' => 1,
            'solved' => true,
            'position' => 1,
        ]);
    }
}
