<?php

namespace Tests\Integration\Infrastructure\Service\Steam;

use App\Steam\Domain\Service\Steam\SteamUserService;
use Exception;
use Tests\TestCase;

class SteamUserServiceTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function testGetPlayerIdPlayerNameAndPlayerFriends(): void
    {
        /** @var SteamUserService $service */
        $service = resolve(SteamUserService::class);
        $steamId = $service->getSteamId('PLAYER');
        $steamName = $service->getSteamName($steamId);
        $steamFriends = $service->getFriends($steamId);

        $this->assertEquals('38421905763284519', $steamId);

        $this->assertEquals('https://avatars.steamstatic.com/b74d83cce1a6f2d78a45e5cc3b64ea0fdb3abfdc.jpg', $steamName['avatar']);
        $this->assertEquals(3, $steamName['communityvisibilitystate']);
        $this->assertEquals(1751661135, $steamName['lastlogoff']);
        $this->assertEquals('Player', $steamName['personaname']);
        $this->assertEquals('https://steamcommunity.com/id/Player/', $steamName['profileurl']);
        $this->assertEquals('38421905763284519', $steamName['steamid']);
        $this->assertEquals(1259854161, $steamName['timecreated']);

        $this->assertCount(2, $steamFriends);

        $friend = [
            "steamid" => "76561198356278439",
            "relationship" => "friend",
            "friend_since" => 1353618732,
        ];
        $this->assertEquals($friend, $steamFriends[0]);
    }

    public function testGetPlayerWithNoFriends(): void
    {
        /** @var SteamUserService $service */
        $service = resolve(SteamUserService::class);
        $steamFriends = $service->getFriends('50783129476018342');

        $this->assertEmpty($steamFriends);
    }

    public function testGetPlayerIdNumeric(): void
    {
        /** @var SteamUserService $service */
        $service = resolve(SteamUserService::class);
        $steamId = $service->getSteamId('38421905763284519');
        $this->assertSame('38421905763284519', $steamId);
    }

    public function testGetSteamIdWithNotFoundPlayer(): void
    {
        /** @var SteamUserService $service */
        $service = resolve(SteamUserService::class);
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('No match found for: PLAYERXXXXXXXXXX');
        $steamId = $service->getSteamId('PLAYERXXXXXXXXXX');
    }
}
