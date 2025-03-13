<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pokemon;

class PokemonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pokemons = [
            // Tipo Fuego
            [
                'nombre' => 'Charmander',
                'tipo' => 'Fuego',
                'stats' => 309,
                'nivel' => 10,
                'entrenador_id' => null
            ],
            [
                'nombre' => 'Vulpix',
                'tipo' => 'Fuego',
                'stats' => 299,
                'nivel' => 15,
                'entrenador_id' => null
            ],
            [
                'nombre' => 'Growlithe',
                'tipo' => 'Fuego',
                'stats' => 350,
                'nivel' => 18,
                'entrenador_id' => null
            ],
            
            // Tipo Agua
            [
                'nombre' => 'Squirtle',
                'tipo' => 'Agua',
                'stats' => 314,
                'nivel' => 10,
                'entrenador_id' => null
            ],
            [
                'nombre' => 'Poliwag',
                'tipo' => 'Agua',
                'stats' => 300,
                'nivel' => 15,
                'entrenador_id' => null
            ],
            [
                'nombre' => 'Psyduck',
                'tipo' => 'Agua',
                'stats' => 320,
                'nivel' => 17,
                'entrenador_id' => null
            ],
            
            // Tipo Planta
            [
                'nombre' => 'Bulbasaur',
                'tipo' => 'Planta',
                'stats' => 318,
                'nivel' => 10,
                'entrenador_id' => null
            ],
            [
                'nombre' => 'Oddish',
                'tipo' => 'Planta',
                'stats' => 320,
                'nivel' => 14,
                'entrenador_id' => null
            ],
            [
                'nombre' => 'Bellsprout',
                'tipo' => 'Planta',
                'stats' => 300,
                'nivel' => 16,
                'entrenador_id' => null
            ],
            
            // Tipo Eléctrico
            [
                'nombre' => 'Pikachu',
                'tipo' => 'Eléctrico',
                'stats' => 320,
                'nivel' => 20,
                'entrenador_id' => null
            ],
            [
                'nombre' => 'Magnemite',
                'tipo' => 'Eléctrico',
                'stats' => 325,
                'nivel' => 15,
                'entrenador_id' => null
            ],
            [
                'nombre' => 'Voltorb',
                'tipo' => 'Eléctrico',
                'stats' => 330,
                'nivel' => 22,
                'entrenador_id' => null
            ],
            
            // Tipo Normal
            [
                'nombre' => 'Eevee',
                'tipo' => 'Normal',
                'stats' => 325,
                'nivel' => 15,
                'entrenador_id' => null
            ],
            [
                'nombre' => 'Rattata',
                'tipo' => 'Normal',
                'stats' => 253,
                'nivel' => 8,
                'entrenador_id' => null
            ],
            [
                'nombre' => 'Jigglypuff',
                'tipo' => 'Normal',
                'stats' => 270,
                'nivel' => 12,
                'entrenador_id' => null
            ],
            
            // Tipo Psíquico
            [
                'nombre' => 'Abra',
                'tipo' => 'Psíquico',
                'stats' => 310,
                'nivel' => 10,
                'entrenador_id' => null
            ],
            [
                'nombre' => 'Slowpoke',
                'tipo' => 'Psíquico',
                'stats' => 315,
                'nivel' => 18,
                'entrenador_id' => null
            ],
            [
                'nombre' => 'Drowzee',
                'tipo' => 'Psíquico',
                'stats' => 328,
                'nivel' => 15,
                'entrenador_id' => null
            ],
            
            // Tipo Lucha
            [
                'nombre' => 'Mankey',
                'tipo' => 'Lucha',
                'stats' => 305,
                'nivel' => 15,
                'entrenador_id' => null
            ],
            [
                'nombre' => 'Machop',
                'tipo' => 'Lucha',
                'stats' => 305,
                'nivel' => 20,
                'entrenador_id' => null
            ],
            
            // Tipo Veneno
            [
                'nombre' => 'Ekans',
                'tipo' => 'Veneno',
                'stats' => 288,
                'nivel' => 15,
                'entrenador_id' => null
            ],
            [
                'nombre' => 'Koffing',
                'tipo' => 'Veneno',
                'stats' => 340,
                'nivel' => 22,
                'entrenador_id' => null
            ],
            
            // Tipo Fantasma
            [
                'nombre' => 'Gastly',
                'tipo' => 'Fantasma',
                'stats' => 310,
                'nivel' => 18,
                'entrenador_id' => null
            ],
            
            // Tipo Tierra
            [
                'nombre' => 'Sandshrew',
                'tipo' => 'Tierra',
                'stats' => 300,
                'nivel' => 17,
                'entrenador_id' => null
            ],
            [
                'nombre' => 'Diglett',
                'tipo' => 'Tierra',
                'stats' => 265,
                'nivel' => 15,
                'entrenador_id' => null
            ],
            
            // Tipo Roca
            [
                'nombre' => 'Geodude',
                'tipo' => 'Roca',
                'stats' => 300,
                'nivel' => 16,
                'entrenador_id' => null
            ],
            [
                'nombre' => 'Onix',
                'tipo' => 'Roca',
                'stats' => 385,
                'nivel' => 25,
                'entrenador_id' => null
            ],
            
            // Tipo Hielo
            [
                'nombre' => 'Seel',
                'tipo' => 'Hielo',
                'stats' => 325,
                'nivel' => 20,
                'entrenador_id' => null
            ],
            
            // Tipo Volador
            [
                'nombre' => 'Pidgey',
                'tipo' => 'Volador',
                'stats' => 251,
                'nivel' => 8,
                'entrenador_id' => null
            ],
            [
                'nombre' => 'Spearow',
                'tipo' => 'Volador',
                'stats' => 262,
                'nivel' => 10,
                'entrenador_id' => null
            ],
        ];

        foreach ($pokemons as $pokemon) {
            Pokemon::create($pokemon);
        }
    }
}