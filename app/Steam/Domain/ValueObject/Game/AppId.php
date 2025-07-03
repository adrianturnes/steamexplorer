<?php

declare(strict_types=1);

namespace App\Steam\Domain\ValueObject\Game;

class AppId
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
