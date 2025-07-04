<?php

declare(strict_types=1);

namespace Tests\Unit\Steam\Domain\Event;

use App\Steam\Domain\Entity\GamePlayer;
use App\Steam\Domain\Event\GamePlayerCreatedEvent;
use App\Steam\Domain\ValueObject\Game\GameId;
use App\Steam\Domain\ValueObject\GamePlayer\PlaytimeForever;
use App\Steam\Domain\ValueObject\GamePlayer\TimeLastPlayed;
use App\Steam\Domain\ValueObject\Player\PlayerId;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Uid\Ulid;

class GamePlayerCreatedEventTest extends TestCase
{
    public function testGamePlayerCreatedEvent(): void
    {
        $playerId = PlayerId::fromUlid(new Ulid());
        $gameId = GameId::fromUlid(new Ulid());
        $playtimeForever = PlaytimeForever::fromInt(3600); // 1 hour in seconds
        $timeLastPlayed = TimeLastPlayed::fromInt(1700000000);
        $gamePlayer = GamePlayer::create(
            $playerId,
            $gameId,
            $playtimeForever,
            $timeLastPlayed
        );

        $event = new GamePlayerCreatedEvent($gamePlayer);
        $this->assertIsInt($event->occurredOn());
        $this->assertEquals($gamePlayer, $event->gamePlayer());
    }
}
