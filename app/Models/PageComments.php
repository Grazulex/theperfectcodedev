<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\State;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $user_id
 * @property int $page_id
 * @property int $response_id
 * @property State $state
 * @property string $content
 * @property User $user
 * @property Page $page
 * @property PageComments $master
 * @property Collection<PageComments> $responses
 * @property Collection<User> $likes
 */
final class PageComments extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'page_id',
        'response_id',
        'state',
        'content'
    ];

    protected $casts = [
        'state' => State::class
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

    public function master(): belongsTo
    {
        return $this->belongsTo(
            related: PageComments::class
        );
    }

    public function responses(): hasMany
    {
        return $this->hasMany(
            related: PageComments::class
        );
    }

    public function likes(): BelongsToMany
    {
        return $this->BelongsToMany(
            related: User::class,
            table: 'comment_user_likes',
        );
    }
}
