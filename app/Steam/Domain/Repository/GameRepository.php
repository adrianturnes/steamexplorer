<?php

namespace App\Steam\Domain\Repository;

use App\Steam\Domain\Entity\Game;
use App\Steam\Domain\ValueObject\Game\GameCollection;

interface GameRepository
{
    public function findOrFailByAppId(int $appId): Game;

    public function saveAll(GameCollection $games): void;
}
