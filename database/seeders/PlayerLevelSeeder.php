<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlayerLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('player_levels')->insert([
            'name' => 'Ruim'
        ]);

        DB::table('player_levels')->insert([
            'name' => 'Regular'
        ]);
        
        DB::table('player_levels')->insert([
            'name' => 'Bom'
        ]);
        
        DB::table('player_levels')->insert([
            'name' => 'Ótimo'
        ]);
        
        DB::table('player_levels')->insert([
            'name' => 'Excelente'
        ]);
    }
}
