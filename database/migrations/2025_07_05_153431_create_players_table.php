<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('players', function (Blueprint $table) {
            $table->ulid('id')->primary()->unique();
            $table->string('steam_id')->unique()->index();
            $table->string('persona_name');
            $table->string('profile_url');
            $table->string('avatar');
            $table->timestamp('last_log_off');
            $table->timestamp('time_created')->nullable();
            $table->integer('community_visibility_state');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('players');
    }
};
