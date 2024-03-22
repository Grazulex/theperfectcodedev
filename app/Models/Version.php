<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\Versions\State;
use App\Models\Scopes\Versions\DefaultScope;
use App\Notifications\Versions\ArchiveNotification;
use App\StateMachines\Contracts\VersionStateContract;
use App\StateMachines\Versions\DraftVersionState;
use App\StateMachines\Versions\PublishVersionState;
use App\StateMachines\Versions\RefusedVersionState;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use InvalidArgumentException;
use Override;

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
    use SoftDeletes;

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

    public function page(): BelongsTo
    {
        return $this->belongsTo(
            related: Page::class
        );
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(
            related: User::class
        );
    }

    public function status(): VersionStateContract
    {
        return match ($this->state) {
            State::DRAFT => new DraftVersionState($this),
            State::PUBLISHED => new PublishVersionState($this),
            State::ARCHIVED => new ArchiveNotification($this),
            State::REFUSED => new RefusedVersionState($this),
            default => throw new InvalidArgumentException('Invalid state'),
        };
    }

    #[Override]
    protected static function booted(): void
    {
        Version::addGlobalScope(new DefaultScope());
    }


}
