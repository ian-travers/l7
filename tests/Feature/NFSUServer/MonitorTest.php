<?php

namespace Tests\Feature\NFSUServer;

use Tests\TestCase;

class MonitorTest extends TestCase
{
    /** @test */
    function anyone_can_visit_server_monitor()
    {
        $this->get('/server/monitor')
            ->assertOk();
    }
}
