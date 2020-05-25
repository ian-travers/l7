<?php

namespace Tests\Feature\Backend;

use App\Entities\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\TestCase;

class DashboardTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function admins_can_view_backend_dashboard()
    {
        $this->withoutExceptionHandling();
        /** @var User $admin */
        $admin = create(User::class);

        $admin->setAdminRights();

        $this->signIn($admin);

        $this->get('/adm')->assertOk();
    }

    /** @test */
    function guests_cannot_view_backend_dashboard()
    {
        $this->get('/adm')
            ->assertStatus(Response::HTTP_FOUND)
            ->assertRedirect('/login');
    }

    /** @test */
    function users_cannot_view_backend_dashboard()
    {
        $this->signIn();

        $this->get('/adm')
            ->assertStatus(Response::HTTP_FOUND)
            ->assertRedirect('/')
            ->assertSessionHas('flash', json_encode([
                'type' => 'warning',
                'title' => __('flash.warning'),
                'message' => __('flash.not-enough-rights'),
            ]));
    }
}
