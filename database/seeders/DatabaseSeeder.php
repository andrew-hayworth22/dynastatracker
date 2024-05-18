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
        $user = User::factory()
            ->create([
                'name' => 'Andy Hayworth',
                'email' => 'andy@example.com',
            ]);

        $dynasties = Dynasty::factory(4)->recycle($user)->create();

        foreach ($dynasties as $dynasty) {
            $conferences = Conference::factory(3)->recycle($dynasty)->create();

            foreach ($conferences as $conference) {
                $divisions = Division::factory(2)->recycle($conference)->create();

                foreach ($divisions as $division) {
                    Team::factory(5)->recycle($division)->create();
                }
            }

            Player::factory(50)->recycle($dynasty)->create();

            $seasons = Season::factory(5)->recycle([$dynasty, $dynasty->teams])->create();
            foreach ($seasons as $season) {
                Game::factory(12)->recycle([$season, $dynasty->teams])->create();
            }
        }
    }
}
