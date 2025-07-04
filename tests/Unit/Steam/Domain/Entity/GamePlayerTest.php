<?php

declare(strict_types=1);

namespace Tests\Unit\Steam\Domain\Entity;

use App\Steam\Domain\Entity\GamePlayer;
use App\Steam\Domain\ValueObject\Game\GameId;
use App\Steam\Domain\ValueObject\GamePlayer\PlaytimeForever;
use App\Steam\Domain\ValueObject\GamePlayer\TimeLastPlayed;
use App\Steam\Domain\ValueObject\Player\PlayerId;
use Carbon\Carbon;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Uid\Ulid;
use function App\Steam\Domain\Entity\GamePlayer;

class GamePlayerTest extends TestCase
{
    public function testGamePlayerCreation(): void
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

        $this->assertInstanceOf(GamePlayer::class, $gamePlayer);
        $this->assertEquals($playerId, $gamePlayer->playerId());
        $this->assertEquals($gameId, $gamePlayer->gameId());
        $this->assertEquals(3600, $gamePlayer->playtimeForever()->value());
        $this->assertEquals(1700000000, $gamePlayer->timeLastPlayed()->value()->timestamp);
        $this->assertNotNull($gamePlayer->createdAt());
        $this->assertNotNull($gamePlayer->updatedAt());
    }

    public function testGamePlayerFromPrimitives(): void
    {
        $gamePlayerId = '01JZA3W8XM5Y30DW8RT0MJ0DCE';
        $playerId = '01JZA3WECV938E07NSA1DTRH67';
        $gameId = '01JZA3WQPXV78DRK30T7DMCFX3';
        $playtimeForever = 7200; // 2 hours in seconds
        $timeLastPlayed = 1700000000; // Example timestamp
        $createdAt = 1700000001; // Example timestamp
        $updatedAt = 1700000002; // Example timestamp

        $gamePlayer = GamePlayer::fromPrimitives(
            $gamePlayerId,
            $playerId,
            $gameId,
            $playtimeForever,
            $timeLastPlayed,
            $createdAt,
            $updatedAt
        );

        $this->assertInstanceOf(GamePlayer::class, $gamePlayer);
        $this->assertEquals($gamePlayerId, $gamePlayer->gamePlayerId()->value()->toString());
        $this->assertEquals($playerId, $gamePlayer->playerId()->value()->toString());
        $this->assertEquals($gameId, $gamePlayer->gameId()->value()->toString());
        $this->assertEquals(7200, $gamePlayer->playtimeForever()->value());
        $this->assertEquals(1700000000, $gamePlayer->timeLastPlayed()->value()->timestamp);
        $this->assertEquals(1700000001, $gamePlayer->createdAt()->timestamp);
        $this->assertEquals(1700000002, $gamePlayer->updatedAt()->timestamp);
    }

    public function testGamePlayerSetters(): void
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

        $newGameId = GameId::fromUlid(new Ulid());
        $newPlayerId = PlayerId::fromUlid(new Ulid());
        $newPlaytimeForever = PlaytimeForever::fromInt(3600);
        $newTimeLastPlayed = TimeLastPlayed::fromInt(1700000005);
        $newUpdatedAt = new Carbon();
        $gamePlayer->setGameId($newGameId);
        $gamePlayer->setPlayerId($newPlayerId);
        $gamePlayer->setPlaytimeForever($newPlaytimeForever);
        $gamePlayer->setTimeLastPlayed($newTimeLastPlayed);
        $gamePlayer->setUpdatedAt($newUpdatedAt);

        $this->assertEquals($newGameId, $gamePlayer->gameId());
        $this->assertEquals($newPlayerId, $gamePlayer->playerId());
        $this->assertEquals($newPlaytimeForever, $gamePlayer->playtimeForever());
        $this->assertEquals($newTimeLastPlayed, $gamePlayer->timeLastPlayed());
        $this->assertEquals($newUpdatedAt->timestamp, $gamePlayer->updatedAt()->timestamp);
    }
}
