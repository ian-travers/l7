<?php

namespace Tests\Feature\Backend\News;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\TestCase;

class ManageNewsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function guests_cannot_manage_news()
    {
        $this->get('/adm/news')
            ->assertStatus(Response::HTTP_FOUND)
            ->assertRedirect('/login');
    }

    /** @test */
    function unauthorized_user_cannot_manage_news()
    {
        $this->signIn();

        $this->get('/adm/news')
            ->assertStatus(Response::HTTP_FOUND)
            ->assertRedirect('/')
            ->assertSessionHas('flash', json_encode([
                'type' => 'warning',
                'title' => __('flash.warning'),
                'message' => __('flash.not-enough-rights'),
            ]));
    }
}
