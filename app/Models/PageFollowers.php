<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $user_id
 * @property int $page_id
 * @property User $user
 * @property Page $page
 */
final class PageFollowers extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'page_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(
            related: User::class
        );
    }

    public function page(): BelongsTo
    {
        return $this->belongsTo(
            related: Page::class
        );
    }
}
