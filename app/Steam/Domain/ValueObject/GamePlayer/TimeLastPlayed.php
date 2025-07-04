<?php

declare(strict_types=1);

namespace App\Steam\Domain\ValueObject\GamePlayer;

use Illuminate\Support\Carbon;

class TimeLastPlayed
{
    private function __construct(private readonly ?Carbon $value)
    {
    }

    public static function fromInt(?int $value): self
    {
        if ($value === null) {
            return new self(null);
        }
        $value = Carbon::createFromTimestamp($value);
        return new self($value);
    }

    public function value(): ?Carbon
    {
        return $this->value;
    }
}
