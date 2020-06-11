<?php

namespace Tests\Feature\Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\TestCase;

class RacerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function anyone_can_visit_racer_test_page()
    {
        $this->get('/tests/racer')->assertStatus(Response::HTTP_OK);
    }
}
