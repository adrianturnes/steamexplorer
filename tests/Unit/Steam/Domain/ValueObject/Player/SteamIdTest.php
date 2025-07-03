<?php

namespace Tests\Unit\Steam\Domain\ValueObject\Player;

use App\Steam\Domain\ValueObject\Player\SteamId;
use PHPUnit\Framework\TestCase;

class SteamIdTest extends TestCase
{
    const STEAM_ID = '76561198000000000';
    public function testSteamId(): void
    {
        $steamIdVO = SteamId::fromString(self::STEAM_ID);

        $this->assertEquals(self::STEAM_ID, $steamIdVO->value());
    }
}
