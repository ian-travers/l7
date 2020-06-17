<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

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
 * @property-read \Illuminate\Database\Eloquent\Collection|Page[] $children
 * @property-read int|null $children_count
 * @property-read int $depth
 * @property-read Page|null $parent
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
 * @method static Builder|Page roots()
 * @mixin \Eloquent
 */
class Page extends Model
{
    use NativeAttributeTrait;

    protected $guarded = [];

    public function parent()
    {
        return $this->belongsTo(static::class, 'parent_id', 'id');
    }

    public function children()
    {
        return $this->hasMany(static::class, 'parent_id', 'id');
    }

    public function getDepthAttribute()
    {
        return $this->calcDepth();
    }

    private function calcDepth(): int
    {
        return $this->parent ? 1 + $this->parent->calcDepth() : 0;
    }

    /**
     * @return string|null
     */
    public function getLinkAttribute()
    {
        return $this->GetNativeAttributeValue('link');
    }

    public function scopeRoots(Builder $query)
    {
        return $query->where('parent_id', null);
    }
}
