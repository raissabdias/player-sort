<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlayerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        # Player names
        $names = [
            'Vicente Lutero Neto',
            'Oliver Ramon de Ferminiano',
            'Milton D\'ávila de Montenegro',
            'Fernando Vitor Sanches Teles',
            'Camilo Jaziel de Bittencourt',
            'Domingos Robert Esteves Ferreira de França',
            'Fred Ortega',
            'Guilherme Benites Neto',
            'Teobaldo José Padilha',
            'Leo Mariano de Carrara Filho',
            'Cauê Aguiar Branco',
            'Agostinho Rafael de Azevedo Neto',
            'Jorge Brito',
            'Alex Cortês de Ramos',
            'Moacyr Oséas de Ferminiano',
            'Karl Robert Assunção de Oliveira',
            'Luke Vinícius Delgado Lozano',
            'Ayrton Ezequiel de Cervantes Neto',
            'Noel Batista Santacruz',
            'Alfredo Edson Abreu de Azevedo',
            'Alex Burgos de Barboza',
            'Lino Furtado',
            'Eliel Joel Furtado Neto',
            'Estevão Otto de Bittencourt Filho',
            'Estêvão Gustavo Gonçalves Serrano de Iglesias'
        ];

        foreach ($names as $name) {
            DB::table('players')->insert([
                'name' => $name,
                'level_id' => rand(1, 5),
                'is_goalkeeper' => rand(0, 1)
            ]);
        }
    }
}
