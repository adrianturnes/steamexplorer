<?php

declare(strict_types=1);

namespace App\Steam\UserInterface\Http\Controllers;

use App\Shared\UserInterface\Controller;
use App\Steam\Application\Command\UpdatePlayerGamesCommand;
use App\Steam\Application\Command\UpdatePlayerGamesCommandHandler;
use Illuminate\Http\Request;

class UpdatePlayerGamesController implements Controller
{
    public function __construct(
        private readonly UpdatePlayerGamesCommandHandler $handler,
    ) {}

    public function __invoke(Request $request): void
    {
        $command = new UpdatePlayerGamesCommand($request->steam_id);
        $this->handler->handle($command);
    }
}
