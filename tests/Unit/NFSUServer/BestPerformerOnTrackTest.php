<?php

namespace Tests\Unit\NFSUServer;

use App\Entities\NFSUServer\BestPerformersOnTrack;
use Tests\TestCase;

class BestPerformerOnTrackTest extends TestCase
{
    public $bestPerformer;
    public $testDataPath = __DIR__ . '/../../NFSUServerData';

    /**
     * @var string
     * @see \App\Entities\NFSUServer\SpecificGameData
     */
    public $trackID = '1001';

    protected function setUp(): void
    {
        parent::setUp();

        $this->bestPerformer = new BestPerformersOnTrack($this->testDataPath, $this->trackID);
    }

    /** @test */
    function it_checks_for_valid_track()
    {
        $this->expectException('DomainException');
        $this->expectExceptionMessage('Unknown track');

        $wrongTrackID = '9999';

        new BestPerformersOnTrack($this->testDataPath, $wrongTrackID);
    }

    /** @test */
    function it_returns_empty_array_if_file_does_not_exists()
    {
        $bp = new BestPerformersOnTrack(__DIR__, $this->trackID); // there should not be "s1001.dat" file
        $result = $bp->rating();

        $this->assertTrue(is_array($result));
        $this->assertEmpty($result);
    }

    /** @test */
    function it_returns_valid_track_id()
    {
        $this->assertEquals('1001', $this->bestPerformer->trackId());
    }

    /** @test */
    function it_returns_valid_track_name()
    {
        $this->assertEquals('Market Street', $this->bestPerformer->trackName());
    }

    /** @test */
    function it_returns_array_if_file_exists()
    {
        $result = $this->bestPerformer->rating();

        $this->assertTrue(is_array($result));
        $this->assertGreaterThan(0, count($result));
        $this->assertArrayHasKey('name', $result[0]);
        $this->assertArrayHasKey('score', $result[0]);
        $this->assertArrayHasKey('car', $result[0]);
        $this->assertArrayHasKey('direction', $result[0]);
    }
}
