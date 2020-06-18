<?php

namespace Tests\Feature\Backend\Pages;

use App\Entities\Page\Page;
use App\Entities\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\TestCase;

class ManagePagesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function guests_cannot_manage_pages()
    {
        $this->get('/adm/pages')
            ->assertStatus(Response::HTTP_FOUND)
            ->assertRedirect('/login');
    }

    /** @test */
    function unauthorized_user_cannot_manage_pages()
    {
        $this->signIn();

        $this->get('/adm/pages')
            ->assertStatus(Response::HTTP_FOUND)
            ->assertRedirect('/')
            ->assertSessionHas('flash', json_encode([
                'type' => 'warning',
                'title' => __('flash.warning'),
                'message' => __('flash.not-enough-rights'),
            ]));
    }

    /** @test */
    function unauthorized_user_cannot_add_a_new_page()
    {
        $this->signIn();

        $this->get('/adm/pages/create')
            ->assertStatus(Response::HTTP_FOUND)
            ->assertRedirect('/')
            ->assertSessionHas('flash', json_encode([
                'type' => 'warning',
                'title' => __('flash.warning'),
                'message' => __('flash.not-enough-rights'),
            ]));
    }

    /** @test */
    function unauthorized_user_cannot_edit_the_page()
    {
        $this->signIn();

        /** @var Page $page */
        $page = create(Page::class);

        $this->get("/adm/pages/{$page->id}/edit", $page->toArray())
            ->assertStatus(Response::HTTP_FOUND)
            ->assertRedirect('/')
            ->assertSessionHas('flash', json_encode([
                'type' => 'warning',
                'title' => __('flash.warning'),
                'message' => __('flash.not-enough-rights'),
            ]));
    }

    /** @test */
    function authorized_user_can_create_a_question()
    {
        /** @var User $admin */
        $admin = factory(User::class)->states('admin')->create();
        $this->signIn($admin);

        $page = make(Page::class);

        $this->post(route('admin.pages.store', $page->toArray()))
            ->assertRedirect(route('admin.pages'));

        $this->assertDatabaseHas('pages', $page->toArray());
    }

    /** @test */
    function authorized_user_can_edit_the_question()
    {
        /** @var User $admin */
        $admin = factory(User::class)->states('admin')->create();
        $this->signIn($admin);

        /** @var Page $page */
        $page = create(Page::class);

        $this->assertDatabaseHas('pages', collect($page->toArray())->except(['created_at', 'updated_at'])->toArray());

        $page->title_en = 'UPD';
        $page->title_ru = 'new str';

        $this->patch("/adm/pages/{$page->id}", $page->toArray());

        $page = $page->fresh();

        $this->assertEquals('UPD', $page->title_en);
        $this->assertEquals('new str', $page->title_ru);
        $this->assertDatabaseHas('pages', collect($page->toArray())->except(['created_at', 'updated_at'])->toArray());
    }

    /** @test */
    function authorized_user_can_delete_the_question()
    {
        $this->withoutExceptionHandling();
        /** @var User $admin */
        $admin = factory(User::class)->states('admin')->create();
        $this->signIn($admin);

        /** @var Page $page */
        $page = create(Page::class);

        $this->assertDatabaseHas('pages', collect($page->toArray())->except(['created_at', 'updated_at'])->toArray());

        $this->delete("/adm/pages/{$page->id}", $page->toArray());

        $this->assertDatabaseMissing('pages', collect($page->toArray())->except(['created_at', 'updated_at'])->toArray());
    }
}
