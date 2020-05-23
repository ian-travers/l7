<?php

namespace App\Entities;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
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
 * @method static Builder|User newModelQuery()
 * @method static Builder|User newQuery()
 * @method static \Illuminate\Database\Query\Builder|User onlyTrashed()
 * @method static Builder|User query()
 * @method static Builder|User whereAvatarPath($value)
 * @method static Builder|User whereCountry($value)
 * @method static Builder|User whereCreatedAt($value)
 * @method static Builder|User whereDeletedAt($value)
 * @method static Builder|User whereEmail($value)
 * @method static Builder|User whereEmailVerifiedAt($value)
 * @method static Builder|User whereId($value)
 * @method static Builder|User whereLocale($value)
 * @method static Builder|User whereName($value)
 * @method static Builder|User whereNickname($value)
 * @method static Builder|User wherePassword($value)
 * @method static Builder|User whereRememberToken($value)
 * @method static Builder|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|User withTrashed()
 * @method static \Illuminate\Database\Query\Builder|User withoutTrashed()
 * @mixin \Eloquent
 */
class User extends Authenticatable
{
    use Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nickname', 'name', 'locale', 'country', 'avatar_path', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

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
//        return (bool) $this->avatar_path && Storage::disk('public')->exists($this->avatar_path);

        return (bool) $this->avatar_path;
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
}
