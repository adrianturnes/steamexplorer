<?php

declare(strict_types=1);

namespace App\Steam\Domain\ValueObject\Game;

class ImgIconUrl
{
    private function __construct(private readonly string $value)
    {
    }

    public static function fromString(string $value): self
    {
        return new self($value);
    }

    public function value(): string
    {
        return $this->value;
    }
}
