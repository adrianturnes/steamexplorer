<?php

declare(strict_types=1);

namespace App\Steam\Domain\Entity;

use App\Shared\Domain\Entity\AggregateRoot;
use App\Steam\Domain\Event\GameCreatedEvent;
use App\Steam\Domain\ValueObject\Game\AppId;
use App\Steam\Domain\ValueObject\Game\GameId;
use App\Steam\Domain\ValueObject\Game\ImgIconUrl;
use App\Steam\Domain\ValueObject\Game\Name;
use Carbon\Carbon;
use Symfony\Component\Uid\Ulid;

class Game extends AggregateRoot
{
    private function __construct(
        private GameId     $gameId,
        private AppId      $appid,
        private Name       $name,
        private ImgIconUrl $imgIconUrl,
        private Carbon     $createdAt,
        private Carbon     $updatedAt
    )
    {
    }

    public static function create(
        AppId      $appid,
        Name       $name,
        ImgIconUrl $imgIconUrl,
    ): self
    {
        $gameId = GameId::fromUlid(new Ulid());
        $createdAt = Carbon::now();
        $updatedAt = Carbon::now();

        $game = new self(
            $gameId,
            $appid,
            $name,
            $imgIconUrl,
            $createdAt,
            $updatedAt
        );

        $game->record(new GameCreatedEvent($game));
        return $game;
    }

    public static function fromPrimitives(
        string $ulid,
        int    $appid,
        string $name,
        string $imgIconUrl,
        int    $createdAt,
        int    $updatedAt
    ): self
    {
        return new self(
            GameId::fromUlid(Ulid::fromString($ulid)),
            AppId::fromInt($appid),
            Name::fromString($name),
            ImgIconUrl::fromString($imgIconUrl),
            Carbon::createFromTimestamp($createdAt),
            Carbon::createFromTimestamp($updatedAt)
        );
    }

    public function gameId(): GameId
    {
        return $this->gameId;
    }

    public function appid(): AppId
    {
        return $this->appid;
    }

    public function setAppid(AppId $appid): void
    {
        $this->appid = $appid;
    }

    public function name(): Name
    {
        return $this->name;
    }

    public function setName(Name $name): void
    {
        $this->name = $name;
    }

    public function imgIconUrl(): ImgIconUrl
    {
        return $this->imgIconUrl;
    }

    public function setImgIconUrl(ImgIconUrl $imgIconUrl): void
    {
        $this->imgIconUrl = $imgIconUrl;
    }

    public function createdAt(): Carbon
    {
        return $this->createdAt;
    }

    public function updatedAt(): Carbon
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(Carbon $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }
}
