<?php

namespace App\Steam\Infrastructure\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $id
 * @property string $steam_id
 * @property string $persona_name
 * @property string $profile_url
 * @property string $avatar
 * @property Carbon $last_log_off
 * @property Carbon|null $time_created
 * @property int $community_visibility_state
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
class Player extends Model
{
    use hasUlids;

    protected $guarded = [];

    protected $casts = [
        'last_log_off' => 'date',
        'time_created' => 'date',
    ];
}
