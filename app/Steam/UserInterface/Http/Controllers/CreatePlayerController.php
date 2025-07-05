<?php

namespace App\Steam\UserInterface\Http\Controllers;

use App\Shared\UserInterface\Controller;
use App\Steam\Application\Command\CreatePlayerCommand;
use App\Steam\Application\Command\CreatePlayerCommandHandler;
use Illuminate\Http\Request;

class CreatePlayerController implements Controller
{
    public function __construct(
        private readonly CreatePlayerCommandHandler $handler,
    ) {}

    public function __invoke(Request $request): void
    {
        $command = new CreatePlayerCommand($request->steam_name);
        $this->handler->handle($command);
    }
}
