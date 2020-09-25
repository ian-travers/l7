<?php

namespace App\Entities;

use App\Entities\Blog\Post\Post;
use DomainException;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use InvalidArgumentException;
use Storage;
use Str;

/**
 * App\Entities\User
 *
 * @property int $id
 * @property string $nickname
 * @property string|null $name
 * @property string $country
 * @property string $locale
 * @property string $role
 * @property bool $is_admin
 * @property string|null $avatar_path
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|Post[] $posts
 * @property-read int|null $posts_count
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Query\Builder|User onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereAvatarPath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereIsAdmin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereLocale($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereNickname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|User withTrashed()
 * @method static \Illuminate\Database\Query\Builder|User withoutTrashed()
 * @mixin \Eloquent
 * @noinspection PhpFullyQualifiedNameUsageInspection
 * @noinspection PhpUnnecessaryFullyQualifiedNameInspection
 */
class User extends Authenticatable
{
    use Notifiable, SoftDeletes;

    public const ROLE_USER = 'user';
    public const ROLE_RACER = 'racer';
    public const ROLE_SUPERVISOR = 'supervisor';

    protected $fillable = [
        'nickname', 'name', 'locale', 'country', 'avatar_path', 'email', 'password', 'is_admin', 'role',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'is_admin' => 'boolean',
    ];

    protected $appends = ['hasAvatar'];

    public static function rolesList(): array
    {
        return [
            self::ROLE_USER => __('auth.user'),
            self::ROLE_RACER => __('auth.racer'),
            self::ROLE_SUPERVISOR => __('auth.supervisor'),
        ];
    }

    public function getRole(): string
    {
        return self::rolesList()[$this->role];
    }

    public function changeRole($role): void
    {
        if (!array_key_exists($role, self::rolesList())) {
            throw new InvalidArgumentException('Unknown role "' . $role . '"');
        }

        if ($this->role === $role) {
            throw new DomainException('This role has already been assigned');
        }

        $this->update(['role' => $role]);
    }

    public function isAdmin(): bool
    {
        return $this->is_admin;
    }

    public function isRacer(): bool
    {
        return $this->role == self::ROLE_RACER;
    }

    public function isSupervisor(): bool
    {
        return $this->role == self::ROLE_SUPERVISOR;
    }

    public function setAdminRights(): void
    {
        $this->update(['is_admin' => true]);
    }

    public function withoutAvatar(): void
    {
        $this->removeAvatarFile();

        $this->update([
            'avatar_path' => null,
        ]);
    }

    public function removeAvatarFile(): bool
    {
        if ($this->hasPreMadeAvatar()) {
            return false;
        }

        return Storage::disk('public')->delete($this->avatar_path);
    }

    public function hasAvatar(): bool
    {
        return (bool) $this->avatar_path && Storage::disk('public')->exists($this->avatar_path);
    }

    public function getHasAvatarAttribute()
    {
        return $this->hasAvatar();
    }

    public function getPreMadeAvatarIndex(): string
    {
        return $this->hasPreMadeAvatar() ? Str::of($this->avatar_path)->after('pre/')->before('.') : '';
    }

    private function hasPreMadeAvatar(): bool
    {
        if ($this->hasAvatar()) {
            return strpos($this->avatar_path, '/pre/');
        }

        return false;
    }

    public function posts()
    {
        return $this->hasMany(Post::class, 'author_id');
    }
}
