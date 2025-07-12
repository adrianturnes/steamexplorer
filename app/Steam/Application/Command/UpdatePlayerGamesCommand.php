<?php

declare(strict_types=1);

namespace App\Steam\Application\Command;

use App\Shared\Application\Command\Command;

class UpdatePlayerGamesCommand implements Command
{
    public function __construct(
        private string $steamId
    ) {
    }

    public function getSteamId(): string
    {
        return $this->steamId;
    }
}
