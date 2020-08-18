<?php

namespace Tests\Feature\Backend\Pages;

use App\Entities\Page\Page;
use App\Entities\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ValidatePageTest extends TestCase
{
    use RefreshDatabase;

    protected function prepareTest(): Page
    {
        /** @var User $admin */
        $admin = factory(User::class)->states('admin')->create();
        $this->signIn($admin);

        return make(Page::class);
    }

    /** @test */
    function page_requires_path()
    {
        $page = $this->prepareTest();

        $this->post(route('admin.pages.store', $page))
            ->assertSessionHasErrors('path');
        $this->assertDatabaseMissing('pages', collect($page->toArray())->except(['created_at', 'updated_at'])->toArray());
    }

    /** @test */
    function page_requires_link_in_english()
    {
        $page = $this->prepareTest();

        $this->post(route('admin.pages.store', $page))
            ->assertSessionHasErrors('link_en');
        $this->assertDatabaseMissing('pages', collect($page->toArray())->except(['created_at', 'updated_at'])->toArray());
    }

    /** @test */
    function page_requires_link_in_russian()
    {
        $page = $this->prepareTest();

        $this->post(route('admin.pages.store', $page))
            ->assertSessionHasErrors('link_ru');
        $this->assertDatabaseMissing('pages', collect($page->toArray())->except(['created_at', 'updated_at'])->toArray());
    }

    /** @test */
    function page_requires_title_in_english()
    {
        $page = $this->prepareTest();

        $this->post(route('admin.pages.store', $page))
            ->assertSessionHasErrors('title_en');
        $this->assertDatabaseMissing('pages', collect($page->toArray())->except(['created_at', 'updated_at'])->toArray());
    }

    /** @test */
    function page_requires_title_in_russian()
    {
        $page = $this->prepareTest();

        $this->post(route('admin.pages.store', $page))
            ->assertSessionHasErrors('title_ru');
        $this->assertDatabaseMissing('pages', collect($page->toArray())->except(['created_at', 'updated_at'])->toArray());
    }

    /** @test */
    function page_requires_content_in_english()
    {
        $page = $this->prepareTest();

        $this->post(route('admin.pages.store', $page))
            ->assertSessionHasErrors('content_en');
        $this->assertDatabaseMissing('pages', collect($page->toArray())->except(['created_at', 'updated_at'])->toArray());
    }

    /** @test */
    function page_requires_content_in_russian()
    {
        $page = $this->prepareTest();

        $this->post(route('admin.pages.store', $page))
            ->assertSessionHasErrors('content_ru');
        $this->assertDatabaseMissing('pages', collect($page->toArray())->except(['created_at', 'updated_at'])->toArray());
    }
}
