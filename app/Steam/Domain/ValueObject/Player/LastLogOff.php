<?php

declare(strict_types=1);

namespace App\Steam\Domain\ValueObject\Player;

use Illuminate\Support\Carbon;

class LastLogOff
{
    private function __construct(private readonly Carbon $value)
    {
    }

    public static function fromInt(int $value): self
    {
        $value = Carbon::createFromTimestamp($value);
        return new self($value);
    }

    public function value(): Carbon
    {
        return $this->value;
    }
}
