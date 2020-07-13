<?php

namespace Tests\Unit\NFSUServer;

use App\Entities\NFSUServer\SpecificGameData;
use Tests\TestCase;

class SpecificDataTest extends TestCase
{
    public $data;

    protected function setUp(): void
    {
        parent::setUp();

        $this->data = new SpecificGameData();
    }

    /** @test */
    function it_returns_all_directions()
    {
        $directions = $this->data->directionsAll();

        $this->assertTrue(is_array($directions));
        $this->assertCount(2, $directions);
    }

    /** @test */
    function it_can_find_certain_direction()
    {
        $this->assertEquals('Forward', $this->data->findDirection(0));
        $this->assertEquals('Unknown direction', $this->data->findDirection(99));
    }

    /** @test */
    function it_returns_all_cars()
    {
        $cars = $this->data->carsAll();

        $this->assertTrue(is_array($cars));
        $this->assertCount(20, $cars);
    }

    /** @test */
    function it_can_find_certain_car()
    {
        $this->assertEquals('Mazda RX-7', $this->data->findCar(8));
        $this->assertEquals('Unknown car', $this->data->findCar(99));
    }

    /** @test */
    function it_returns_all_tracks()
    {
        $tracks = $this->data->tracksAll();

        $this->assertTrue(is_array($tracks));
        $this->assertCount(30, $tracks);
    }

    /** @test */
    function it_can_find_certain_track()
    {
        $this->assertEquals('Stadium', $this->data->findTrack('1002'));
        $this->assertEquals('Liberty Gardens', $this->data->findTrack('1102'));
        $this->assertEquals('Highway 1', $this->data->findTrack('1202'));
        $this->assertEquals('Drift Track 2', $this->data->findTrack('1302'));
        $this->assertEquals('Unknown track', $this->data->findTrack('9999'));
    }
}
