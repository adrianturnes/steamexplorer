<?php

namespace App\Steam\Application\Command;

use App\Shared\Application\Command\Command;

readonly class CreatePlayerCommand implements Command
{
    public function __construct(
        private string $userName
    ) {
    }

    public function getUserName(): string
    {
        return $this->userName;
    }
}
