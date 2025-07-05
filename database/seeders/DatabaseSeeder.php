<?php

namespace Database\Seeders;

use app\Steam\Infrastructure\Models\User;
use Illuminate\Database\Seeder;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            PlayerSeeder::class,
        ]);
    }
}
