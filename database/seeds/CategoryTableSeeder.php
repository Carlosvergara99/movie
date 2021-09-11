<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('category')->insert([
            
            ['name' => 'Accion'],
            ['name' => 'Animacion'],
            ['name' => 'Ciencia Ficcion'],
            ['name' => 'Comedia'],
            ['name' => 'Crimen'],
            ['name' => 'Documental'],
            ['name' => 'Drama'],
            ['name' => 'Fantasia'],
            ['name' => 'Foreing'],
            ['name' => 'Guerra'],
            ['name' => 'Historia'],
            ['name' => 'Romance'],
            ['name' => 'Suspenso'],
            ['name' => 'Terror'],
            ['name' => 'Misterio'],
        ]);
    }
}
