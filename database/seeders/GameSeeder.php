<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GameSeeder extends Seeder
{
    public const TEST_GAME_1_ID = '01JZQ0FV0XT2DAXF8XDS4KGKFD';
    public const TEST_GAME_1_APP_ID = '7365218';

    public function run(): void
    {
        $this->createGame1();
    }

    private function createGame1(): void
    {
        DB::table('games')->insert([
            'id' => self::TEST_GAME_1_ID,
            'app_id' => self::TEST_GAME_1_APP_ID,
            'name' => 'Test Game 1',
            'img_icon_url' => 'https://example.com/game1_icon.jpg',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
