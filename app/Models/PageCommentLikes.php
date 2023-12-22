<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $user_id
 * @property int $page_comment_id
 * @property bool $liked
 * @property User $user
 * @property PageComments $pageComment
 */
final class PageCommentLikes extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'page_comment_id',
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

    public function pageComment(): belongsTo
    {
        return $this->belongsTo(
            related: PageComments::class
        );
    }
}
