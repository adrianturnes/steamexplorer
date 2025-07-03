<?php

declare(strict_types=1);

namespace App\Steam\Domain\Entity;

use App\Shared\Domain\Entity\AggregateRoot;
use App\Steam\Domain\Event\PlayerCreatedEvent;
use App\Steam\Domain\ValueObject\Player\Avatar;
use App\Steam\Domain\ValueObject\Player\CommunityVisibilityState;
use App\Steam\Domain\ValueObject\Player\LastLogOff;
use App\Steam\Domain\ValueObject\Player\PersonaName;
use App\Steam\Domain\ValueObject\Player\PlayerId;
use App\Steam\Domain\ValueObject\Player\ProfileUrl;
use App\Steam\Domain\ValueObject\Player\SteamId;
use App\Steam\Domain\ValueObject\Player\TimeCreated;
use Carbon\Carbon;
use Symfony\Component\Uid\Ulid;

class Player extends AggregateRoot
{
    private function __construct(
        private PlayerId                 $playerId,
        private SteamId                  $steamId,
        private PersonaName              $personaName,
        private ProfileUrl               $profileUrl,
        private Avatar                   $avatar,
        private LastLogOff               $lastLogOff,
        private TimeCreated              $timeCreated,
        private CommunityVisibilityState $communityVisibilityState,
        private Carbon $createdAt,
        private Carbon $updatedAt
    )
    {
    }

    public static function create(
        SteamId                  $steamId,
        PersonaName              $personName,
        ProfileUrl               $profileUrl,
        Avatar                   $avatar,
        LastLogOff               $lastLogOff,
        TimeCreated              $timeCreated,
        CommunityVisibilityState $communityVisibilityState
    ): self
    {
        $playerId = PlayerId::fromUlid(new Ulid());
        $createdAt = Carbon::now();
        $updatedAt = Carbon::now();
        $player = new self(
            $playerId,
            $steamId,
            $personName,
            $profileUrl,
            $avatar,
            $lastLogOff,
            $timeCreated,
            $communityVisibilityState,
            $createdAt,
            $updatedAt
        );

        $player->record(new PlayerCreatedEvent($player));

        return $player;
    }

    public function playerId(): PlayerId
    {
        return $this->playerId;
    }

    public function steamId(): SteamId
    {
        return $this->steamId;
    }

    public function setSteamId(SteamId $steamId): void
    {
        $this->steamId = $steamId;
    }

    public function personaName(): PersonaName
    {
        return $this->personaName;
    }

    public function setPersonaName(PersonaName $personaName): void
    {
        $this->personaName = $personaName;
    }

    public function profileUrl(): ProfileUrl
    {
        return $this->profileUrl;
    }

    public function setProfileUrl(ProfileUrl $profileUrl): void
    {
        $this->profileUrl = $profileUrl;
    }

    public function avatar(): Avatar
    {
        return $this->avatar;
    }

    public function setAvatar(Avatar $avatar): void
    {
        $this->avatar = $avatar;
    }

    public function lastLogOff(): LastLogOff
    {
        return $this->lastLogOff;
    }

    public function setLastLogOff(LastLogOff $lastLogOff): void
    {
        $this->lastLogOff = $lastLogOff;
    }

    public function timeCreated(): TimeCreated
    {
        return $this->timeCreated;
    }

    public function setTimeCreated(TimeCreated $timeCreated): void
    {
        $this->timeCreated = $timeCreated;
    }

    public function communityVisibilityState(): CommunityVisibilityState
    {
        return $this->communityVisibilityState;
    }

    public function setCommunityVisibilityState(CommunityVisibilityState $communityVisibilityState): void
    {
        $this->communityVisibilityState = $communityVisibilityState;
    }

    public function createdAt(): Carbon
    {
        return $this->createdAt;
    }

    public function updatedAt(): Carbon
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(Carbon $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }
}
