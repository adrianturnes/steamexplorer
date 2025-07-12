<?php

declare(strict_types=1);

namespace App\Steam\Infrastructure\Persistence;

use App\Steam\Domain\Entity\Game;
use App\Steam\Domain\Exception\GameNotFoundException;
use App\Steam\Domain\Repository\GameRepository;
use App\Steam\Domain\ValueObject\Game\GameCollection;
use App\Steam\Infrastructure\Models\Game as EloquentGame;

class EloquentGameRepository implements GameRepository
{

    public function findOrFailByAppId(int $appId): Game
    {
        $game = EloquentGame::query()->where('app_id', '=', $appId)->first();
        if (!$game) {
            throw new GameNotFoundException();
        }

        return $this->fromPrimitives($game);
    }

    public function saveAll(GameCollection $games): void
    {
        $arrData = [];

        /** @var Game $game */
        foreach ($games as $game) {
            $arrData[] = [
                'id' => $game->gameId()->value(),
                'app_id' => $game->appid()->value(),
                'name' => $game->name()->value(),
                'img_icon_url' => $game->imgIconUrl()->value(),
                'created_at' => $game->createdAt()->toDateTimeString(),
                'updated_at' => $game->updatedAt()->toDateTimeString(),
            ];
        }

        EloquentGame::query()->upsert($arrData, 'id');
    }

    private function fromPrimitives(EloquentGame $game): Game
    {
        return Game::fromPrimitives(
            $game->id,
            $game->app_id,
            $game->name,
            $game->img_icon_url,
            $game->created_at?->timestamp,
            $game->updated_at?->timestamp
        );
    }
}
