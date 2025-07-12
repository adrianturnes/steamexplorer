<?php

namespace App\Steam\Domain\ValueObject\Game;

use App\Shared\Domain\ValueObject\TypedCollection;
use App\Steam\Domain\Entity\Game;

class GameCollection extends TypedCollection
{
    protected function type(): string
    {
        return Game::class;
    }
}
