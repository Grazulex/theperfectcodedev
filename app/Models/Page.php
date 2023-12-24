<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\State;
use App\Services\Pages\FollowersService;
use App\Services\Pages\LikesService;
use App\StateMachines\Contracts\PageStateContract;
use App\StateMachines\Pages\ArchivedPageState;
use App\StateMachines\Pages\DraftPageState;
use App\StateMachines\Pages\PublishedPageState;
use App\StateMachines\Pages\RefusedPageState;
use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use InvalidArgumentException;

/**
 * @property string $title
 * @property string $slug
 * @property string $resume
 * @property string $content
 * @property array $tags
 * @property int $user_id
 * @property int $version
 * @property State $state
 * @property null|CarbonInterface $published_at
 * @property User $user
 * @property Collection<Version> $versions
 * @property Collection<User> $likes
 * @property Collection<PageComments> $comments
 * @property Collection<PageCommentLikes> $commentLikes
 * @property Collection<User> $followers
 */
final class Page extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'resume',
        'content',
        'tags',
        'user_id',
        'version',
        'state',
        'published_at'
    ];

    protected $casts = [
        'tags' => 'array',
        'state' => State::class,
        'published_at' => 'datetime'
    ];

    public function user(): belongsTo
    {
        return $this->belongsTo(
            related: User::class
        );
    }

    public function versions(): hasMany
    {
        return $this->hasMany(
            related: Version::class
        );
    }

    public function likes(): BelongsToMany
    {
        return $this->BelongsToMany(
            related: User::class,
            table: 'page_user_likes',
        );
    }


    public function comments(): hasMany
    {
        return $this->hasMany(
            related: PageComments::class
        );
    }

    public function followers(): BelongsToMany
    {
        return $this->BelongsToMany(
            related: User::class,
            table: 'page_user_followers',
        );
    }

    public function likesService(): LikesService
    {
        return new LikesService($this);
    }

    public function followersService(): FollowersService
    {
        return new FollowersService($this);
    }


    public function status(): PageStateContract
    {
        return match ($this->state) {
            State::DRAFT => new DraftPageState($this),
            State::PUBLISHED => new PublishedPageState($this),
            State::ARCHIVED => new ArchivedPageState($this),
            State::REFUSED => new RefusedPageState($this),
            default => throw new InvalidArgumentException('Invalid state'),
        };
    }
}
