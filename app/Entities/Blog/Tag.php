<?php

namespace App\Entities\Blog;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Entities\Blog\Tag
 *
 * @property int $id
 * @property string $name
 * @property string|null $slug
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Blog\Tag newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Blog\Tag newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Blog\Tag query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Blog\Tag whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Blog\Tag whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Blog\Tag whereSlug($value)
 * @mixin \Eloquent
 * @noinspection PhpFullyQualifiedNameUsageInspection
 * @noinspection PhpUnnecessaryFullyQualifiedNameInspection
 */
class Tag extends Model
{
    protected $guarded = [];

    public $timestamps = false;
}
