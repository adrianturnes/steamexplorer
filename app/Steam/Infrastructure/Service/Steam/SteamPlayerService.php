<?php

declare(strict_types=1);

namespace App\Steam\Infrastructure\Service\Steam;

use Illuminate\Support\Facades\Http;

class SteamPlayerService implements \App\Steam\Domain\Service\Steam\SteamPlayerService
{
    private const BASE_URL = 'http://api.steampowered.com/IPlayerService';
    private const OWNED_GAMES_URL = '/GetOwnedGames/v0001';

    public function getOwnedGames(string $steamId): array
    {
        $url = '/?key=' . config('steam.api_key') . '&steamid=' . $steamId . '&format=json&include_appinfo=1';
        $response = Http::get(self::BASE_URL . self::OWNED_GAMES_URL . $url);
        $data = json_decode($response->body(), true);
        return $data['response']['games'] ?? [];
    }
}
