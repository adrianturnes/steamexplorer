<?php

namespace Tests\Integration\Infrastructure\Service\Steam;

use App\Steam\Domain\Service\Steam\SteamPlayerService;
use Tests\TestCase;

class SteamPlayerServiceTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        /** @var SteamPlayerService $service */
        $service = resolve(SteamPlayerService::class);
        $result = $service->getOwnedGames('38421905763284519');

        $this->assertCount(5, $result);
        $game = [
            "appid" => 2183900,
            "name" => "Warhammer 40,000: Space Marine 2",
            "playtime_forever" => 4883,
            "img_icon_url" => "0fccfb5eb2acb934db1fe95a4e578f25ccbd71ec",
            "has_community_visible_stats" => true,
            "playtime_windows_forever" => 4883,
            "playtime_mac_forever" => 0,
            "playtime_linux_forever" => 0,
            "playtime_deck_forever" => 0,
            "rtime_last_played" => 1733335556,
            "content_descriptorids" => [
                0 => 2,
                1 => 5,
            ],
            "playtime_disconnected" => 0,
        ];

        $this->assertContains($game, $result);
    }
}
