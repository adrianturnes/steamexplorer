<?php

namespace App\Steam\Infrastructure\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $id
 * @property string $player_id
 * @property string $game_id
 * @property int $total_playtime
 * @property Carbon|null $last_time_played
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
class GamePlayer extends Model
{
    use hasUlids;

    protected $table = 'game_player';

    protected $casts = [
        'last_time_played' => 'date',
    ];
}
