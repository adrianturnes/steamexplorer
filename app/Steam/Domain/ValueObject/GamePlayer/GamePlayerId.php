<?php

declare(strict_types=1);

namespace App\Steam\Domain\ValueObject\GamePlayer;

use Symfony\Component\Uid\Ulid;

class GamePlayerId
{
    private function __construct(private readonly Ulid $value)
    {
    }

    public static function fromUlid(Ulid $value): self
    {
        return new self($value);
    }

    public function value(): Ulid
    {
        return $this->value;
    }
}
