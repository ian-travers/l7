<?php

namespace App\UseCases\Blog;

use App\Entities\Blog\Tag;
use App\Repositories\Blog\TagRepository;
use Str;

class TagManageService
{
    private $tags;

    public function __construct(TagRepository $tags)
    {
        $this->tags = $tags;
    }

    public function create(string $name): Tag
    {
        $tag = new Tag();
        $tag->name = $name;
        $tag->slug = Str::slug($name);
        $this->tags->save($tag);

        return $tag;
    }

    public function edit(int $id, string $name): void
    {
        $tag = $this->tags->get($id);
        $tag->name = $name;
        $tag->slug = Str::slug($name);
        $this->tags->save($tag);
    }

    public function remove($id): void
    {
        $tag = $this->tags->get($id);
        $this->tags->remove($tag);
    }
}
