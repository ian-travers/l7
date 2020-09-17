<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Entities\Like
 *
 * @property int $id
 * @property int $user_id
 * @property int $liked_id
 * @property string $liked_type
 * @property int $is_dislike
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Like newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Like newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Like query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Like whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Like whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Like whereIsDislike($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Like whereLikedId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Like whereLikedType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Like whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Like whereUserId($value)
 * @mixin \Eloquent
 * @noinspection PhpFullyQualifiedNameUsageInspection
 * @noinspection PhpUnnecessaryFullyQualifiedNameInspection
 */
class Like extends Model
{
    protected $guarded = [];

    public function toggle()
    {
        $this->is_dislike = !$this->is_dislike;

        $this->save();
    }
}
