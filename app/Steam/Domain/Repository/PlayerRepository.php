<?php

namespace App\Steam\Domain\Repository;
use App\Steam\Domain\Entity\Player;
use App\Steam\Domain\ValueObject\Player\PlayerCollection;
use App\Steam\Infrastructure\Models\Player as EloquentPlayer;
use Symfony\Component\Uid\Ulid;

interface PlayerRepository
{
    public function findBySteamId(string $steamId): ?Player;
    public function save(Player $player): void;
}
