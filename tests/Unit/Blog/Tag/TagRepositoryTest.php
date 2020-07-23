<?php

namespace Tests\Unit;

use App\Entities\Blog\Tag;
use App\Repositories\Blog\TagRepository;
use App\Repositories\NotFoundException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use RuntimeException;
use Tests\TestCase;

class TagRepositoryTest extends TestCase
{
    use RefreshDatabase;

    public $tagRepository;

    protected function setUp(): void
    {
        parent::setUp();

        $this->tagRepository = new TagRepository();
    }

    /** @test */
    function it_can_save_valid_tag()
    {
        /** @var Tag $tag */
        $tag = new Tag();

        $tag->name = 'tag';

        $this->tagRepository->save($tag);

        $this->assertDatabaseHas('tags', $tag->toArray());
    }

    /** @test */
    function it_can_get_existing_tag_by_id()
    {
        /** @var Tag $tag */
        $tag = new Tag();

        $tag->name = 'tag';
        $tag->slug = 'tag';
        $this->tagRepository->save($tag);

        $foundTag = $this->tagRepository->get(1);

        $this->assertEquals($tag->toArray(), $foundTag->toArray());
    }

    /** @test */
    function it_throws_an_exception_when_try_to_get_by_wrong_id()
    {
        $this->expectException(NotFoundException::class);
        $this->expectExceptionMessage('Tag is not found.');

        $this->tagRepository->get(1);
    }

    /** @test */
    function it_can_find_existing_tag()
    {
        /** @var Tag $tag */
        $tag = new Tag();

        $tag->name = 'tag';
        $tag->slug = 'tag';
        $this->tagRepository->save($tag);

        $foundTag = $this->tagRepository->findByName('tag');

        $this->assertEquals($tag->toArray(), $foundTag->toArray());
    }

    /** @test */
    function it_returns_null_when_tag_not_found()
    {
        $foundTag = $this->tagRepository->findByName('tag');

        $this->assertNull($foundTag);
    }

    /** @test */
    function it_can_delete_a_tag()
    {
        /** @var Tag $tag */
        $tag = new Tag();

        $tag->name = 'tag';

        $this->tagRepository->save($tag);

        $this->assertDatabaseHas('tags', $tag->toArray());

        $this->tagRepository->remove($tag);

        $this->assertDatabaseMissing('tags', $tag->toArray());
    }

    /** @test */
    function it_throws_an_exception_when_try_to_delete_by_wrong_id()
    {
        /** @var Tag $tag */
        $tag = new Tag();

        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('Unable to remove the tag.');

        $this->tagRepository->remove($tag);
    }
}
