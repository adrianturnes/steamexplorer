<?php

declare(strict_types=1);

namespace App\Steam\Domain\ValueObject\Player;

class CommunityVisibilityState
{
    private function __construct(private readonly int $value)
    {
    }

    public static function fromInt(int $value): self
    {
        return new self($value);
    }

    public function value(): int
    {
        return $this->value;
    }
}
