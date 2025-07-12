<?php

declare(strict_types=1);

namespace App\Steam\Infrastructure\Persistence;

use App\Steam\Domain\Entity\GamePlayer;
use App\Steam\Domain\Repository\GamePlayerRepository;
use App\Steam\Domain\ValueObject\GamePlayer\GamePlayerCollection;
use App\Steam\Domain\ValueObject\Player\PlayerId;
use App\Steam\Infrastructure\Models\GamePlayer as EloquentGamePlayer;
use Illuminate\Support\Collection;

class EloquentGamePlayerRepository implements GamePlayerRepository
{
    public function findGamesByPlayerId(PlayerId $playerId): GamePlayerCollection
    {
        $gamePlayers = EloquentGamePlayer::query()->where('player_id', $playerId->value())->get();

        return new GamePlayerCollection($this->fromPrimitivesArray($gamePlayers));
    }

    public function save(GamePlayerCollection $collection): void
    {
        $arrData = [];
        /** @var GamePlayer $gamePlayer */
        foreach ($collection as $gamePlayer) {
            $arrData[] = [
                'id' => $gamePlayer->gamePlayerId()->value(),
                'player_id' => $gamePlayer->playerId()->value(),
                'game_id' => $gamePlayer->gameId()->value(),
                'total_playtime' => $gamePlayer->playtimeForever()->value(),
                'last_time_played' => $gamePlayer->timeLastPlayed()->value()?->getTimestamp(),
            ];
        }

        EloquentGamePlayer::query()->upsert($arrData, ['id'], ['total_playtime', 'last_time_played']);
    }

    /**
     * @param Collection<int, EloquentGamePlayer> $gamePlayers
     */
    private function fromPrimitivesArray(Collection $gamePlayers): array
    {
        $arrData = [];
        /** @var EloquentGamePlayer $gamePlayer */
        foreach ($gamePlayers as $gamePlayer) {
            $arrData[] = GamePlayer::fromPrimitives(
                $gamePlayer->id,
                $gamePlayer->player_id,
                $gamePlayer->game_id,
                $gamePlayer->total_playtime,
                $gamePlayer->last_time_played?->getTimestamp(),
                $gamePlayer->created_at?->getTimestamp(),
                $gamePlayer->updated_at?->getTimestamp()
            );
        }
        return $arrData;
    }
}
