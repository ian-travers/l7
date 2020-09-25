<?php

namespace Tests\Feature\Backend;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DashboardTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function guests_cannot_view_backend_dashboard()
    {
        $this->get('/adm')
            ->assertRedirect('/login');
    }

    /** @test */
    function users_cannot_view_backend_dashboard()
    {
        $this->signIn();

        $this->get('/adm')
            ->assertRedirect('/')
            ->assertSessionHas('flash', json_encode([
                'type' => 'warning',
                'title' => __('flash.warning'),
                'message' => __('flash.not-enough-rights'),
            ]));
    }
}
