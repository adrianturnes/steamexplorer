<?php

namespace App\Steam\Infrastructure\Persistence;

use App\Steam\Domain\Entity\Player;
use App\Steam\Domain\Repository\PlayerRepository;
use App\Steam\Infrastructure\Models\Player as EloquentPlayer;
use Symfony\Component\Uid\Ulid;


class EloquentPlayerRepository implements PlayerRepository
{
    public function findBySteamId(string $steamId): ?Player
    {
        $player = EloquentPlayer::query()->where('steam_id', '=', $steamId)->first();

        if (!$player) {
            return null;
        }

        return $this->fromPrimitives($player);
    }

    public function save(Player $player): void
    {
        EloquentPlayer::query()->updateOrCreate(
            [
                'id' => $player->playerId()->value(),
                'steam_id' => $player->steamId()->value(),
                'persona_name' => $player->personaName()->value(),
                'profile_url' => $player->profileUrl()->value(),
                'avatar' => $player->avatar()->value(),
                'last_log_off' => $player->lastLogOff()->value()->getTimestamp(),
                'time_created' => $player->timeCreated()->value()?->getTimestamp(),
                'community_visibility_state' => $player->communityVisibilityState()->value()
            ],
        );
    }

    /**
     * @param EloquentPlayer $player
     * @return Player
     */
    public function fromPrimitives(EloquentPlayer $player): Player
    {
        return Player::fromPrimitives(
            $player->id,
            $player->steam_id,
            $player->persona_name,
            $player->profile_url,
            $player->avatar,
            $player->last_log_off->getTimestamp(),
            $player->time_created?->getTimestamp(),
            $player->community_visibility_state,
            $player->created_at?->getTimestamp(),
            $player->updated_at?->getTimestamp()
        );
    }
}
