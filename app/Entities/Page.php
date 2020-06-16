<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

/**
 * App\Entities\Page
 *
 * @property int $id
 * @property int|null $parent_id
 * @property string $path
 * @property string $link_en
 * @property string $link_ru
 * @property string $title_en
 * @property string $title_ru
 * @property string $content_en
 * @property string $content_ru
 * @property string|null $seo
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static Builder|Page newModelQuery()
 * @method static Builder|Page newQuery()
 * @method static Builder|Page query()
 * @method static Builder|Page whereContentEn($value)
 * @method static Builder|Page whereContentRu($value)
 * @method static Builder|Page whereCreatedAt($value)
 * @method static Builder|Page whereId($value)
 * @method static Builder|Page whereLinkEn($value)
 * @method static Builder|Page whereLinkRu($value)
 * @method static Builder|Page whereParentId($value)
 * @method static Builder|Page wherePath($value)
 * @method static Builder|Page whereSeo($value)
 * @method static Builder|Page whereTitleEn($value)
 * @method static Builder|Page whereTitleRu($value)
 * @method static Builder|Page whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Page extends Model
{
    protected $guarded = [];
}
