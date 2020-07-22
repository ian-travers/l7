<?php

namespace App\Repositories\Blog;

use App\Entities\Blog\Tag;
use App\Repositories\NotFoundException;
use RuntimeException;

class TagRepository
{
    public function get(int $id): Tag
    {
        if (!$tag = Tag::find($id)) {
            throw new NotFoundException('Tag is not found.');
        }

        return $tag;
    }

    public function findByName(string $name): ?Tag
    {
        return Tag::firstWhere('name', $name);
    }

    public function save(Tag $tag): void
    {
        if (!$tag->save()) {
            throw new RuntimeException('Unable to save the tag.');
        }
    }

    public function remove(Tag $tag): void
    {
        if (!$tag->delete()) {
            throw new RuntimeException('Unable to remove the tag.');
        }
    }
}
