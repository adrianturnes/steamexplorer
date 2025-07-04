<?php

declare(strict_types=1);

namespace App\Steam\Domain\Entity;

use App\Shared\Domain\Entity\AggregateRoot;
use App\Steam\Domain\Event\GamePlayerCreatedEvent;
use App\Steam\Domain\ValueObject\Game\GameId;
use App\Steam\Domain\ValueObject\GamePlayer\GamePlayerId;
use App\Steam\Domain\ValueObject\GamePlayer\PlaytimeForever;
use App\Steam\Domain\ValueObject\GamePlayer\TimeLastPlayed;
use App\Steam\Domain\ValueObject\Player\PlayerId;
use Carbon\Carbon;
use Symfony\Component\Uid\Ulid;

class GamePlayer extends AggregateRoot
{
    private function __construct(
        private GamePlayerId    $gamePlayerId,
        private PlayerId        $playerId,
        private GameId          $gameId,
        private PlaytimeForever $playtimeForever,
        private TimeLastPlayed  $timeLastPlayed,
        private ?Carbon         $createdAt,
        private ?Carbon         $updatedAt
    )
    {
    }

    public static function create(
        PlayerId               $playerId,
        GameId                 $gameId,
        PlaytimeForever        $playtimeForever,
        TimeLastPlayed         $timeLastPlayed
    ): self
    {
        $gamePlayerId = GamePlayerId::fromUlid(new Ulid());
        $createdAt = Carbon::now();
        $updatedAt = Carbon::now();

        $gamePlayer = new self(
            $gamePlayerId,
            $playerId,
            $gameId,
            $playtimeForever,
            $timeLastPlayed,
            $createdAt,
            $updatedAt
        );

        $gamePlayer->record(new GamePlayerCreatedEvent($gamePlayer));
        return $gamePlayer;
    }

    public static function fromPrimitives(
        string $gamePlayerId,
        string $playerId,
        string $gameId,
        int    $playtimeForever,
        ?int   $timeLastPlayed,
        ?int   $createdAt,
        ?int   $updatedAt
    ): self
    {
        $createdAt = $createdAt ? Carbon::createFromTimestamp($createdAt) : null;
        $updatedAt = $updatedAt ? Carbon::createFromTimestamp($updatedAt) : null;
        return new self(
            GamePlayerId::fromUlid(Ulid::fromString($gamePlayerId)),
            PlayerId::fromUlid(Ulid::fromString($playerId)),
            GameId::fromUlid(Ulid::fromString($gameId)),
            PlaytimeForever::fromInt($playtimeForever),
            TimeLastPlayed::fromInt($timeLastPlayed),
            $createdAt,
            $updatedAt
        );
    }

    public function gamePlayerId(): GamePlayerId
    {
        return $this->gamePlayerId;
    }

    public function gameId(): GameId
    {
        return $this->gameId;
    }

    public function setGameId(GameId $gameId): void
    {
        $this->gameId = $gameId;
    }

    public function playerId(): PlayerId
    {
        return $this->playerId;
    }

    public function setPlayerId(PlayerId $playerId): void
    {
        $this->playerId = $playerId;
    }

    public function playtimeForever(): PlaytimeForever
    {
        return $this->playtimeForever;
    }

    public function setPlaytimeForever(PlaytimeForever $playtimeForever): void
    {
        $this->playtimeForever = $playtimeForever;
    }

    public function timeLastPlayed(): TimeLastPlayed
    {
        return $this->timeLastPlayed;
    }

    public function setTimeLastPlayed(TimeLastPlayed $timeLastPlayed): void
    {
        $this->timeLastPlayed = $timeLastPlayed;
    }

    public function createdAt(): ?Carbon
    {
        return $this->createdAt;
    }

    public function updatedAt(): ?Carbon
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(Carbon $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }
}
