<?php

namespace Acceptance\Command;

use App\Steam\Domain\Exception\PlayerAlreadyExistsException;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class CreatePlayerTest extends TestCase
{
    use DatabaseTransactions;
    const URL = '/player/{steam_name}';

    public function test_create_player(): void
    {
        $url = $this->prepareUrl('PLAYER');
        $response = $this->post($url);
        $response->assertStatus(200);
    }

    public function test_create_player_that_already_exists(): void
    {
        $url = $this->prepareUrl('TestPlayer');
        $response = $this->post($url);
        $response->assertSee('PlayerAlreadyExistsException');
    }

    private function prepareUrl(string $string)
    {
        return str_replace('{steam_name}', $string, self::URL);
    }
}
