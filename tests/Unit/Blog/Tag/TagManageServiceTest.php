<?php

namespace Tests\Unit;

use App\Entities\Blog\Tag;
use App\Repositories\Blog\TagRepository;
use App\UseCases\Blog\TagManageService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TagManageServiceTest extends TestCase
{
    use RefreshDatabase;

    public $tagManageService;

    protected function setUp(): void
    {
        parent::setUp();

        $this->tagManageService = new TagManageService(new TagRepository());
    }

    /** @test */
    function it_can_create_and_persist_a_tag()
    {
        $tag = $this->tagManageService->create('turn');

        $this->assertInstanceOf(Tag::class, $tag);
        $this->assertDatabaseHas('tags', $tag->toArray());
    }

    /** @test */
    function it_can_edit_and_persist_existing_tag()
    {
        $tag = $this->tagManageService->create('turn');

        $this->assertEquals('turn', $tag->name);
        $this->assertEquals('turn', $tag->slug);
        $this->assertDatabaseHas('tags', $tag->toArray());

        $this->tagManageService->edit($tag->id, 'New name');

        $this->assertEquals('New name', $tag->refresh()->name);
        $this->assertEquals('new-name', $tag->slug);
        $this->assertDatabaseHas('tags', $tag->toArray());
    }

    /** @test */
    function it_can_remove_existing_tag()
    {
        $tag = $this->tagManageService->create('turn');

        $this->assertDatabaseHas('tags', $tag->toArray());

        $this->tagManageService->remove($tag->id);

        $this->assertDatabaseMissing('tags', $tag->toArray());
    }
}
