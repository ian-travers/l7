<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * App\Entities\Comment
 *
 * @property int $id
 * @property int $user_id
 * @property int|null $parent_id
 * @property string $body
 * @property string $commentable_type
 * @property int $commentable_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Entities\User $author
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $commentable
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Comment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Comment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Comment query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Comment whereBody($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Comment whereCommentableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Comment whereCommentableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Comment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Comment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Comment whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Comment whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Comment whereUserId($value)
 * @mixin \Eloquent
 * @noinspection PhpFullyQualifiedNameUsageInspection
 * @noinspection PhpUnnecessaryFullyQualifiedNameInspection
 */
class Comment extends Model
{
    protected $guarded = ['id'];

    public function commentable(): MorphTo
    {
        return $this->morphTo();
    }

    public function author()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Create a comment and persist it.
     *
     * @param Model $commentable
     * @param string $body
     * @param User $author
     * @param Comment|null $parent
     *
     * @return static
     */
    public static function createComment(Model $commentable, string $body, User $author, self $parent = null): self
    {
        return $commentable->comments()->create([
            'body' => $body,
            'user_id' => $author->id,
            'parent_id' => $parent ? $parent->id : null,
        ]);
    }

    /**
     * Update a comment by an ID
     *
     * @param int $id
     * @param array $data
     *
     * @return bool
     */
    public static function updateComment(int $id, array $data)
    {
        return (bool) static::find($id)->update($data);
    }

    /**
     * Delete a comment by an ID
     *
     * @param int $id
     *
     * @return bool
     * @throws \Exception
     */
    public static function deleteComment(int $id): bool
    {
        return (bool) static::find($id)->delete();
    }
}
