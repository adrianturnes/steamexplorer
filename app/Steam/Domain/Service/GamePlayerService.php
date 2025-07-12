<?php

namespace App\Steam\Domain\Service;

use App\Steam\Domain\Entity\Player;

interface GamePlayerService
{
    public function getPlayerWithGames(string $steamId): Player;
}
