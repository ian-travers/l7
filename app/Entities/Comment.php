<?php

namespace App\Entities;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Purify;

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
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Create a comment and persist it.
     *
     * @param Model $commentable
     * @param string $body
     * @param User|Authenticatable $author
     * @param int|null $parent_id
     *
     * @return static
     */
    public static function createComment($commentable, $body, $author, $parent_id = null): self
    {
        return $commentable->comments()->create([
            'body' => Purify::clean($body),
            'user_id' => $author->id,
            'parent_id' => $parent_id ? (int)$parent_id : null,
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
    public static function updateComment($id, $data)
    {
        return (bool)static::find($id)->update($data);
    }

    /**
     * Delete a comment by an ID
     *
     * @param int $id
     *
     * @return bool
     * @throws \Exception
     */
    public static function deleteComment($id): bool
    {
        return (bool)static::find($id)->delete();
    }

    public static function treeRecursive(&$comments, $parentId): array
    {
        $items = [];

        /** @var self $comment */
        foreach ($comments as $comment) {
            if ($comment->parent_id == $parentId) {
                $items[] = new CommentView($comment, self::treeRecursive($comments, $comment->id));
            }
        }

        return $items;
    }

    public function hasChild(): bool
    {
        /** @var self $comment */
        foreach (self::all() as $comment) {
            if ($comment->parent_id == $this->id) {
                return true;
            }
        }

        return false;
    }
}
