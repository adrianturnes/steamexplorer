<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GamePlayerSeeder extends Seeder
{
    public const TEST_GAME_PLAYER_1_ID = '01JZQ0PWPY8B2P1DF2YFR32EFG';

    public function run(): void
    {
        $this->createGamePlayer1();
    }

    private function createGamePlayer1(): void
    {
        DB::table('game_player')->insert([
            'id' => self::TEST_GAME_PLAYER_1_ID,
            'player_id' => PlayerSeeder::TEST_PLAYER_1_ID,
            'game_id' => GameSeeder::TEST_GAME_1_ID,
            'total_playtime' => 2440,
            'last_time_played' => 1356336000,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
