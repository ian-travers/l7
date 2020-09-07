<?php

namespace App\Entities\News;

use App\Entities\Comment;
use App\Entities\NativeAttributeTrait;
use App\Entities\User;
use Carbon\Carbon;
use Illuminate\Contracts\Auth\Authenticatable;
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
 * @property-read \App\Entities\User $author
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Entities\Comment[] $comments
 * @property-read int|null $comments_count
 * @property-read mixed $body
 * @property-read mixed $title
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

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    /**
     * Create a comment
     *
     * @param string $body
     * @param User|Authenticatable $author
     * @param int|null $parent_id
     *
     * @return Comment
     */
    public function comment(string $body, User $author, ?int $parent_id = null)
    {
        return Comment::createComment($this, $body, $author, $parent_id);
    }

    /**
     * Update a comment
     *
     * @param $id
     * @param $body
     *
     * @return bool
     */
    public function updateComment($id, $body)
    {
        return Comment::updateComment($id, $body);
    }

    /**
     * Delete a comment
     *
     * @param $id
     *
     * @return bool
     * @throws \Exception
     */
    public function deleteComment($id)
    {
        return Comment::deleteComment($id);
    }

    /**
     * The amount of comments assigned to this model
     *
     * @return int
     */
    public function commentsCount(): int
    {
        return $this->comments->count();
    }
}
