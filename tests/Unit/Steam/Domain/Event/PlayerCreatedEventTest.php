<?php

namespace Tests\Unit\Steam\Domain\Event;

use App\Steam\Domain\Entity\Player;
use App\Steam\Domain\Event\PlayerCreatedEvent;
use App\Steam\Domain\ValueObject\Player\Avatar;
use App\Steam\Domain\ValueObject\Player\CommunityVisibilityState;
use App\Steam\Domain\ValueObject\Player\LastLogOff;
use App\Steam\Domain\ValueObject\Player\PersonaName;
use App\Steam\Domain\ValueObject\Player\ProfileUrl;
use App\Steam\Domain\ValueObject\Player\SteamId;
use App\Steam\Domain\ValueObject\Player\TimeCreated;
use PHPUnit\Framework\TestCase;

class PlayerCreatedEventTest extends TestCase
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

        $event = new PlayerCreatedEvent($player);
        $this->assertIsInt($event->occurredOn());
        $this->assertEquals($player, $event->player());
    }
}
