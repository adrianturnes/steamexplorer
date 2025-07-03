<?php

declare(strict_types=1);

namespace App\Steam\Domain\ValueObject\Game;

use Symfony\Component\Uid\Ulid;

class GameId
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
