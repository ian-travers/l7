<?php

namespace App\Entities\News;

use App\Entities\NativeAttributeTrait;
use App\Entities\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Str;

/**
 * \App\Entities\News\News
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
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\News\News newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\News\News newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Entities\News\News onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\News\News query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\News\News whereAuthorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\News\News whereBodyEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\News\News whereBodyRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\News\News whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\News\News whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\News\News whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\News\News whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\News\News whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\News\News whereTitleEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\News\News whereTitleRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\News\News whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Entities\News\News withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Entities\News\News withoutTrashed()
 * @mixin \Eloquent
 * @noinspection PhpFullyQualifiedNameUsageInspection
 * @noinspection PhpUnnecessaryFullyQualifiedNameInspection
 */
class News extends Model
{
    use SoftDeletes, NativeAttributeTrait;

    protected $guarded = [];

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
