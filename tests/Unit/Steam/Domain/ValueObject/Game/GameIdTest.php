<?php

declare(strict_types=1);

namespace Tests\Unit\Steam\Domain\ValueObject\Game;

use App\Steam\Domain\ValueObject\Game\GameId;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Uid\Ulid;

class GameIdTest extends TestCase
{
    public function testGameId(): void
    {
        $ulid = new Ulid();
        $gameId = GameId::fromUlid($ulid);

        $this->assertInstanceOf(GameId::class, $gameId);
        $this->assertSame($ulid, $gameId->value());
    }
}
