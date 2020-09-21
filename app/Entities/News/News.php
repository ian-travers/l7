<?php

namespace App\Entities\News;

use App\Entities\HasComments;
use App\Entities\HasLikesDislikes;
use App\Entities\NativeAttributeTrait;
use App\Entities\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Str;

/**
 * App\Entities\News\News
 *
 * @property int $id
 * @property int $author_id
 * @property string $title_en
 * @property string $title_ru
 * @property string $slug
 * @property string $body_en
 * @property string $body_ru
 * @property int $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read User $author
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Entities\Comment[] $comments
 * @property-read int|null $comments_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Entities\Like[] $dislikes
 * @property-read int|null $dislikes_count
 * @property-read mixed $body
 * @property-read mixed $is_disliked
 * @property-read mixed $is_liked
 * @property-read mixed $title
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Entities\Like[] $likes
 * @property-read int|null $likes_count
 * @method static \Illuminate\Database\Eloquent\Builder|News newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|News newQuery()
 * @method static \Illuminate\Database\Query\Builder|News onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|News query()
 * @method static \Illuminate\Database\Eloquent\Builder|News whereAuthorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|News whereBodyEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|News whereBodyRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|News whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|News whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|News whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|News whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|News whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|News whereTitleEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|News whereTitleRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|News whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|News withTrashed()
 * @method static \Illuminate\Database\Query\Builder|News withoutTrashed()
 * @mixin \Eloquent
 * @noinspection PhpFullyQualifiedNameUsageInspection
 * @noinspection PhpUnnecessaryFullyQualifiedNameInspection
 */
class News extends Model
{
    use SoftDeletes, NativeAttributeTrait, HasComments, HasLikesDislikes;

    protected $guarded = [];

    protected $appends = ['isLiked', 'isDisliked'];

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function setSlugAttribute()
    {
        $this->attributes['slug'] = Str::slug(trim($this->title_en));
    }

    public function getTitleAttribute()
    {
        return $this->GetNativeAttributeValue('title');
    }

    public function getBodyAttribute()
    {
        return $this->GetNativeAttributeValue('body');
    }

    public function createdAtHtml()
    {
        Carbon::setLocale(app()->getLocale());

        return $this->created_at->toDateString() . ' (' .$this->created_at->diffForHumans() . ')';
    }
}
