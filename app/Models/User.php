<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use JoelButcher\Socialstream\HasConnectedAccounts;
use JoelButcher\Socialstream\SetsProfilePhotoFromUrl;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Jetstream\HasTeams;
use Laravel\Sanctum\HasApiTokens;

/**
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string $profile_photo_path
 * @property string $two_factor_secret
 * @property string $two_factor_recovery_codes
 * @property string $remember_token
 * @property string $current_team_id
 * @property string $email_verified_at
 * @property string $profile_photo_url
 * @property Collection<Page> $pages
 * @property Collection<Version> $versions
 * @property Collection<Page> $likes
 * @property Collection<PageComments> $comments
 * @property Collection<PageComments> $commentLikes
 * @property Collection<Page> $followers
 */
final class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens;
    use HasConnectedAccounts;
    use HasFactory;
    use HasProfilePhoto {
        HasProfilePhoto::profilePhotoUrl as getPhotoUrl;
    }
    use HasTeams;
    use Notifiable;
    use SetsProfilePhotoFromUrl;
    use TwoFactorAuthenticatable;

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    public function commentLikes(): BelongsToMany
    {
        return $this->BelongsToMany(
            related: PageComments::class,
            table: 'comment_user_likes',
        );
    }


    public function comments(): HasMany
    {
        return $this->hasMany(
            related: PageComments::class
        );
    }

    public function followers(): BelongsToMany
    {
        return $this->BelongsToMany(
            related: Page::class,
            table: 'page_user_followers',
        );
    }

    public function likes(): BelongsToMany
    {
        return $this->BelongsToMany(
            related: Page::class,
            table: 'page_user_likes',
        );
    }

    public function pages(): HasMany
    {
        return $this->hasMany(
            related: Page::class
        );
    }

    /**
     * Get the URL to the user's profile photo.
     */
    public function profilePhotoUrl(): Attribute
    {
        return filter_var($this->profile_photo_path, FILTER_VALIDATE_URL)
            ? Attribute::get(fn() => $this->profile_photo_path)
            : $this->getPhotoUrl();
    }

    public function versions(): HasMany
    {
        return $this->hasMany(
            related: Version::class
        );
    }
}
