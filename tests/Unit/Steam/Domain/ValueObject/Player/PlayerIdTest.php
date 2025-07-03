<?php

namespace Tests\Unit\Steam\Domain\ValueObject\Player;

use App\Steam\Domain\ValueObject\Player\PlayerId;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Uid\Ulid;

class PlayerIdTest extends TestCase
{
    public function testPlayerId(): void
    {
        $ulid = new Ulid();
        $playerId = PlayerId::fromUlid($ulid);

        $this->assertEquals($ulid, $playerId->value());
    }
}
