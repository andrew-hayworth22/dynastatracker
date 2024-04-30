<?php

namespace Database\Seeders;

use App\Models\Conference;
use App\Models\Division;
use App\Models\Dynasty;
use App\Models\Game;
use App\Models\Player;
use App\Models\Season;
use App\Models\Team;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()
            ->has(Dynasty::factory(4)
                ->has(Conference::factory(3)
                    ->has(Division::factory(2)
                        ->has(Team::factory(5))))
                ->has(Season::factory(5)
                    ->has(Game::factory(10)))
                ->has(Player::factory(50)))
            ->create([
                'name' => 'Andy Hayworth',
                'email' => 'andy@example.com',
            ]);
    }
}
