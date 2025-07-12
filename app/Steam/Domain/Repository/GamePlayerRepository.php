<?php

namespace App\Steam\Domain\Repository;

use App\Steam\Domain\ValueObject\GamePlayer\GamePlayerCollection;
use App\Steam\Domain\ValueObject\Player\PlayerId;

interface GamePlayerRepository
{
    public function findGamesByPlayerId(PlayerId $playerId): GamePlayerCollection;

    public function save(GamePlayerCollection $collection): void;
}
