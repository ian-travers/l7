<?php

namespace Tests\Feature\User;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\TestCase;

class TestingTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    function user_can_visit_racer_test_page()
    {
        $this->withoutExceptionHandling();
        $this->signIn();

        $this->get('/tests/racer')->assertStatus(Response::HTTP_OK);
    }
}
