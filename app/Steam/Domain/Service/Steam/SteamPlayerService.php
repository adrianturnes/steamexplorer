<?php

declare(strict_types=1);

namespace App\Steam\Domain\Service\Steam;

interface SteamPlayerService
{
    public function getOwnedGames(string $steamId): array;

}
