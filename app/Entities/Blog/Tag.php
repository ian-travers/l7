<?php

namespace App\Entities\Blog;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Entities\Blog\Tag
 *
 * @property int $id
 * @property string $name
 * @property string|null $slug
 * @method static Builder|Tag newModelQuery()
 * @method static Builder|Tag newQuery()
 * @method static Builder|Tag query()
 * @method static Builder|Tag whereId($value)
 * @method static Builder|Tag whereName($value)
 * @method static Builder|Tag whereSlug($value)
 * @mixin \Eloquent
 */
class Tag extends Model
{
    protected $guarded = [];

    public $timestamps = false;
}
