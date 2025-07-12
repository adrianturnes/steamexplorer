<?php

namespace App\Steam\Domain\ValueObject\GamePlayer;

use App\Shared\Domain\ValueObject\TypedCollection;
use App\Steam\Domain\Entity\GamePlayer;

class GamePlayerCollection extends TypedCollection
{
    protected function type(): string
    {
        return GamePlayer::class;
    }
}
