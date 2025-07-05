<?php

declare(strict_types=1);

namespace App\Steam\Domain\Service\Steam;

interface SteamUserService
{
    public function getSteamId(string $userName): string;
    public function getSteamName(string $steamId): array;
    public function getFriends(string $steamId): array;
}
