<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $user_id
 * @property int $page_id
 * @property bool $liked
 * @property User $user
 * @property Page $page
 */
final class PageLikes extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'page_id',
        'liked'
    ];

    protected $casts = [
        'liked' => 'boolean'
    ];

    public function user(): belongsTo
    {
        return $this->belongsTo(
            related: User::class
        );
    }

    public function page(): belongsTo
    {
        return $this->belongsTo(
            related: Page::class
        );
    }
}
