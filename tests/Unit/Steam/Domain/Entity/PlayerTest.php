<?php

namespace Tests\Unit\Steam\Domain\Entity;

use App\Steam\Domain\Entity\Player;
use App\Steam\Domain\ValueObject\Player\Avatar;
use App\Steam\Domain\ValueObject\Player\CommunityVisibilityState;
use App\Steam\Domain\ValueObject\Player\LastLogOff;
use App\Steam\Domain\ValueObject\Player\PersonaName;
use App\Steam\Domain\ValueObject\Player\PlayerId;
use App\Steam\Domain\ValueObject\Player\ProfileUrl;
use App\Steam\Domain\ValueObject\Player\SteamId;
use App\Steam\Domain\ValueObject\Player\TimeCreated;
use Carbon\Carbon;
use PHPUnit\Framework\TestCase;

class PlayerTest extends TestCase
{
    public function testPlayerCreation(): void
    {
        $steamId = SteamId::fromString('123456789');
        $personaName = PersonaName::fromString('TestPersona');
        $profileUrl = ProfileUrl::fromString('http://example.com');
        $avatar = Avatar::fromString('http://example.com/avatar.jpg');
        $lastLogOff = LastLogOff::fromInt(1672531200);
        $timeCreated = TimeCreated::fromInt(1672531200);
        $communityVisibilityState = CommunityVisibilityState::fromInt(3);

        $player = Player::create(
            $steamId,
            $personaName,
            $profileUrl,
            $avatar,
            $lastLogOff,
            $timeCreated,
            $communityVisibilityState
        );

        $this->assertInstanceOf(Player::class, $player);
        $this->assertInstanceOf(PlayerId::class, $player->playerId());
        $this->assertInstanceOf(Carbon::class, $player->createdAt());
        $this->assertInstanceOf(Carbon::class, $player->updatedAt());
        $this->assertEquals($steamId, $player->steamId());
        $this->assertEquals($personaName, $player->personaName());
        $this->assertEquals($profileUrl, $player->profileUrl());
        $this->assertEquals($avatar, $player->avatar());
        $this->assertEquals($lastLogOff, $player->lastLogOff());
        $this->assertEquals($timeCreated, $player->timeCreated());
        $this->assertEquals($communityVisibilityState, $player->communityVisibilityState());
    }

    public function testPlayerSetters(): void
    {
        $player = Player::create(
            SteamId::fromString('123456789'),
            PersonaName::fromString('TestPersona'),
            ProfileUrl::fromString('http://example.com'),
            Avatar::fromString('http://example.com/avatar.jpg'),
            LastLogOff::fromInt(1672531200),
            TimeCreated::fromInt(1672531200),
            CommunityVisibilityState::fromInt(3)
        );

        $newSteamId = SteamId::fromString('987654321');
        $newPersonaName = PersonaName::fromString('NewPersona');
        $newProfileUrl = ProfileUrl::fromString('http://newexample.com');
        $newAvatar = Avatar::fromString('http://newexample.com/avatar.jpg');
        $newLastLogOff = LastLogOff::fromInt(1672617600);
        $newTimeCreated = TimeCreated::fromInt(1672617600);
        $newCommunityVisibilityState = CommunityVisibilityState::fromInt(2);
        $newUpdatedAt = Carbon::now();

        $player->setSteamId($newSteamId);
        $player->setPersonaName($newPersonaName);
        $player->setProfileUrl($newProfileUrl);
        $player->setAvatar($newAvatar);
        $player->setLastLogOff($newLastLogOff);
        $player->setTimeCreated($newTimeCreated);
        $player->setCommunityVisibilityState($newCommunityVisibilityState);
        $player->setUpdatedAt($newUpdatedAt);

        $this->assertEquals($newSteamId, $player->steamId());
        $this->assertEquals($newPersonaName, $player->personaName());
        $this->assertEquals($newProfileUrl, $player->profileUrl());
        $this->assertEquals($newAvatar, $player->avatar());
        $this->assertEquals($newLastLogOff, $player->lastLogOff());
        $this->assertEquals($newTimeCreated, $player->timeCreated());
        $this->assertEquals($newCommunityVisibilityState, $player->communityVisibilityState());
        $this->assertEquals($newUpdatedAt, $player->updatedAt());
    }
}
