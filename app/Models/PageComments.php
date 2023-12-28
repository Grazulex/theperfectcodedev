<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\Comments\State;
use App\StateMachines\Comments\PublishedCommentState;
use App\StateMachines\Comments\RefusedCommentState;
use App\StateMachines\Contracts\CommentStateContract;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use InvalidArgumentException;

/**
 * @property int $user_id
 * @property int $page_id
 * @property int $response_id
 * @property string $content
 * @property User $user
 * @property Page $page
 * @property State $state
 * @property PageComments $master
 * @property Collection<PageComments> $responses
 * @property Collection<User> $likes
 */
final class PageComments extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'page_id',
        'response_id',
        'content',
        'state',
    ];

    protected $casts = [
        'state' => State::class,
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
            related: PageComments::class,
            foreignKey: 'response_id',
            ownerKey: 'id',
            relation: 'master'
        );
    }

    public function responses(): hasMany
    {
        return $this->hasMany(
            related: PageComments::class,
            foreignKey: 'response_id',
            localKey: 'id'
        );
    }

    public function likes(): BelongsToMany
    {
        return $this->BelongsToMany(
            related: User::class,
            table: 'comment_user_likes',
        );
    }

    public function status(): CommentStateContract
    {
        return match ($this->state) {
            State::PUBLISHED => new PublishedCommentState($this),
            State::REFUSED => new RefusedCommentState($this),
            default => throw new InvalidArgumentException('Invalid state'),
        };
    }
}
