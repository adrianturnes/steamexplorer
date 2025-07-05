<?php

namespace App\Shared\Infrastructure\Providers;

use App\Steam\Domain\Service\Steam\SteamPlayerService as ISteamPlayerService;
use App\Steam\Domain\Service\Steam\SteamUserService as ISteamUserService;
use App\Steam\Infrastructure\Service\Steam\SteamPlayerService;
use App\Steam\Infrastructure\Service\Steam\SteamUserService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //Services
        $this->app->bind(ISteamPlayerService::class, SteamPlayerService::class);
        $this->app->bind(ISteamUserService::class, SteamUserService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
