<?php

namespace Acceptance\Command;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class UpdatePlayerGamesTest extends TestCase
{
    use DatabaseTransactions;
    const URL = '/player/{steam_id}/games';

    public function test_update_player(): void
    {
        $url = $this->prepareUrl('12345678901234567');
        $response = $this->put($url);
        $response->assertStatus(200);

    }

    public function test_update_player_with_missing_player(): void
    {
        $url = $this->prepareUrl('99999999999999999');
        $response = $this->put($url);
        $response->assertSee('PlayerNotFoundException');

    }

    private function prepareUrl(string $string)
    {
        return str_replace('{steam_id}', $string, self::URL);
    }
}
