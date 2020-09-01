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
}
