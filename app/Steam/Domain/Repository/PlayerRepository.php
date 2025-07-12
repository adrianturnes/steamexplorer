<?php

namespace App\Steam\Domain\Repository;

use App\Steam\Domain\Entity\Player;

interface PlayerRepository
{
    public function findOrFailBySteamId(string $steamId): Player;
    public function findBySteamId(string $steamId): ?Player;
    public function save(Player $player): void;
}
