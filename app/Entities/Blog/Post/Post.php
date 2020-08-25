<?php

namespace App\Entities\Blog\Post;

use App\Entities\Blog\Tag;
use App\Entities\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Purify;
use Storage;
use Str;

/**
 * App\Entities\Blog\Post\Post
 *
 * @property int $id
 * @property int $author_id
 * @property string $title
 * @property string $slug
 * @property string|null $excerpt
 * @property string|null $body
 * @property string|null $image
 * @property int $views_count
 * @property \Illuminate\Support\Carbon|null $published_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Entities\User $author
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Entities\Blog\Tag[] $tags
 * @property-read int|null $tags_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Blog\Post\Post newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Blog\Post\Post newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Entities\Blog\Post\Post onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Blog\Post\Post published()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Blog\Post\Post query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Blog\Post\Post whereAuthorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Blog\Post\Post whereBody($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Blog\Post\Post whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Blog\Post\Post whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Blog\Post\Post whereExcerpt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Blog\Post\Post whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Blog\Post\Post whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Blog\Post\Post wherePublishedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Blog\Post\Post whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Blog\Post\Post whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Blog\Post\Post whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Blog\Post\Post whereViewsCount($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Entities\Blog\Post\Post withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Entities\Blog\Post\Post withoutTrashed()
 * @mixin \Eloquent
 * @noinspection PhpFullyQualifiedNameUsageInspection
 * @noinspection PhpUnnecessaryFullyQualifiedNameInspection
 */
class Post extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    protected $dates = ['published_at'];

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function createTags(string $str): void
    {
        $tags = explode(',', $str);

        $tagIds = [];

        foreach ($tags as $tag) {
            $newTag = Tag::firstOrCreate([
                'slug' => Str::slug(trim($tag)),
                'name' => ucwords(trim($tag)),
            ]);

            $tagIds[] = $newTag->id;
        }

        $this->tags()->sync($tagIds);
    }

    public function hasImage(): bool
    {
        return (bool)$this->image;
    }

    public function withoutImage(): void
    {
        if ($this->hasImage()) {
            Storage::disk('public')->delete($this->image);
            $this->update([
                'image' => null,
            ]);
        }
    }

    public function imageUrl(): ?string
    {
        return $this->image ? asset($this->image) : null;
    }

    public function publish(): void
    {
        $this->published_at = Carbon::now();
        $this->save();
    }

    public function unpublish(): void
    {
        $this->published_at = null;
        $this->save();
    }

    public function isPublished(): bool
    {
        return isset($this->published_at) ? $this->published_at <= Carbon::now() : false;
    }

    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = static::firstWhere('slug', $value)
            ? Str::slug(trim($this->title)) . '-' . $this->id
            : Str::slug(trim($this->title));
    }

    public function getExcerptAttribute(?string $excerpt): ?string
    {
        return str_replace(['{{', '}}', '{!!', '!!}'], ['{[', ']}', '{[!', '!]}'], Purify::clean($excerpt));
    }

    public function getBodyAttribute(?string $body): ?string
    {
        return str_replace(['{{', '}}', '{!!', '!!}'], ['{[', ']}', '{[!', '!]}'], Purify::clean($body));
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('published_at', '<=', Carbon::now());
    }
}
