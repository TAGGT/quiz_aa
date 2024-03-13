<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert([
            'name' => 'game',            
        ]);
        
        DB::table('categories')->insert([
            'name' => 'book',            
        ]);
        
        DB::table('categories')->insert([
            'name' => 'geography',            
        ]);
        
        DB::table('categories')->insert([
            'name' => 'trivia',            
        ]);
            
    }
}
