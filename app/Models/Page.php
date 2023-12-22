<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\State;
use App\StateMachines\Contracts\PageStateContract;
use App\StateMachines\Pages\ArchivedPageState;
use App\StateMachines\Pages\DraftPageState;
use App\StateMachines\Pages\PublishedPageState;
use App\StateMachines\Pages\RefusedPageState;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use InvalidArgumentException;

/**
 * @property string $title
 * @property string $slug
 * @property string $description
 * @property array $tags
 * @property int $user_id
 * @property int $version
 * @property State $state
 * @property User $user
 * @property Collection<Version> $versions
 * @property Collection<PageLikes> $likes
 * @property Collection<PageComments> $comments
 */
final class Page extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'tags',
        'user_id',
        'version',
        'state',
    ];

    protected $casts = [
        'tags' => 'array',
        'state' => State::class
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

    public function likes(): hasMany
    {
        return $this->hasMany(
            related: PageLikes::class
        );
    }

    public function comments(): hasMany
    {
        return $this->hasMany(
            related: PageComments::class
        );
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
