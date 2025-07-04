<?php

declare(strict_types=1);

namespace Tests\Unit\Steam\Domain\ValueObject\GamePlayer;

use App\Steam\Domain\ValueObject\GamePlayer\GamePlayerId;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Uid\Ulid;

class GamePlayerIdTest extends TestCase
{
    public function testGamePlayerId(): void
    {
        $ulid = new Ulid();
        $gamePlayerId = GamePlayerId::fromUlid($ulid);

        $this->assertInstanceOf(GamePlayerId::class, $gamePlayerId);
        $this->assertSame($ulid, $gamePlayerId->value());
    }
}
