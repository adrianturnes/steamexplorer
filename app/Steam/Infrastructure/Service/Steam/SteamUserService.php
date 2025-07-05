<?php

declare(strict_types=1);

namespace App\Steam\Infrastructure\Service\Steam;

use Exception;
use Illuminate\Support\Facades\Http;

class SteamUserService implements \App\Steam\Domain\Service\Steam\SteamUserService
{
    private const BASE_URL = 'http://api.steampowered.com/ISteamUser';
    private const STEAM_ID_URL = '/ResolveVanityURL/v0001';
    private const STEAM_NAME_URL = '/GetPlayerSummaries/v0002';
    private const STEAM_FRIENDS_URL = '/GetFriendList/v0001';

    public function getSteamId(string $userName): string
    {
        if ((is_numeric($userName)) && (strlen($userName) == 17)) {
            return $userName;
        }

        $url = self::BASE_URL . self::STEAM_ID_URL . '?key=' . config('steam.api_key') . '&vanityurl=' . $userName;
        $response = Http::get($url);
        $data = json_decode($response->body(), true);

        if (array_key_exists('message', $data['response']) && $data['response']['message'] == 'No match') {
            throw new Exception('No match found for: ' . $userName);
        }
        $steamId = $data['response']['steamid'];
        return $steamId;

    }

    public function getSteamName(string $steamId): array
    {
        $url = self::BASE_URL . self::STEAM_NAME_URL . '?key=' . config('steam.api_key') . '&steamids=' . $steamId;
        $response = Http::get($url);
        $data = json_decode($response->body(), true);
        return $data['response']['players'][0];
    }

    public function getFriends(string $steamId): array
    {
        $url = self::BASE_URL . self::STEAM_FRIENDS_URL . '?key=' . config('steam.api_key') . '&steamid=' . $steamId . '&relationship=friend';
        $response = Http::get($url);
        $data = json_decode($response->body(), true);

        if (!array_key_exists('friendslist', $data)) {
            return [];
        };
        return $data['friendslist']['friends'];
    }
}
