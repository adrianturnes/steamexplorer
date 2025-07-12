<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlayerSeeder extends Seeder
{
    public const TEST_PLAYER_1_ID = '01JZDZRANQK2A9H7PSFEXJ72NF';
    public const TEST_PLAYER_1_STEAM_ID = '12345678901234567';

    public function run(): void
    {
        $this->createPlayer1();
    }

    private function createPlayer1(): void
    {
        DB::table('players')->insert([
            'id' => self::TEST_PLAYER_1_ID,
            'steam_id' => self::TEST_PLAYER_1_STEAM_ID,
            'persona_name' => 'TestPlayer',
            'profile_url' => 'https://steamcommunity.com/id/testplayer',
            'avatar' => 'https://example.com/avatar.jpg',
            'last_log_off' => now(),
            'time_created' => now(),
            'community_visibility_state' => 3,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
