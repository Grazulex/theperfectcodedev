<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\State;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property null|int $version
 * @property int $page_id
 * @property string $description
 * @property string $code
 * @property int $user_id
 * @property State $state
 * @property Page $page
 * @property User $user
 */
final class Version extends Model
{
    use HasFactory;

    protected $fillable = [
        'version',
        'page_id',
        'description',
        'code',
        'user_id',
        'state'
    ];

    protected $casts = [
        'state' => State::class
    ];

    public function page(): belongsTo
    {
        return $this->belongsTo(
            related: Page::class
        );
    }

    public function user(): belongsTo
    {
        return $this->belongsTo(
            related: User::class
        );
    }


}
