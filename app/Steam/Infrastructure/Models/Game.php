<?php

namespace App\Steam\Infrastructure\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $id
 * @property int $app_id
 * @property string $name
 * @property string $img_icon_url
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
class Game extends Model
{
    use hasUlids;

    protected $guarded = [];
}
