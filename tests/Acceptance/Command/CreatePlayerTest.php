<?php

namespace Acceptance\Command;

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

    private function prepareUrl(string $string)
    {
        return str_replace('{steam_name}', $string, self::URL);
    }
}
