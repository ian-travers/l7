<?php

namespace Tests\Unit\NFSUServer;

use App\Entities\NFSUServer\BestPerformers;
use Tests\TestCase;

class ServerBestPerformersTest extends TestCase
{
    public $bestPerformers;

    /**
     * @var string
     * @see \App\Entities\NFSUServer\SpecificGameData
     */
    public $trackID = '1001';

    protected function setUp(): void
    {
        parent::setUp();

        $this->bestPerformers = new BestPerformers(__DIR__ . '/../../NFSUServerData', $this->trackID);
    }

    /** @test */
    function it_checks_for_valid_track()
    {
        $this->expectException('DomainException');
        $this->expectExceptionMessage('Unknown track');

        $wrongTrackID = '9999';

        new BestPerformers(__DIR__ . '/../../NFSUServerData', $wrongTrackID);
    }

    /** @test */
    function it_returns_empty_array_if_file_does_not_exists()
    {
        $bp = new BestPerformers(__DIR__, $this->trackID); // there should not be "s1001.dat" file
        $result = $bp->getAll();

        $this->assertTrue(is_array($result));
        $this->assertEmpty($result);
    }

    /** @test */
    function it_returns_valid_track_id()
    {
        $this->assertEquals('1001', $this->bestPerformers->getTrackId());
    }

    /** @test */
    function it_returns_valid_track_name()
    {
        $this->assertEquals('Market Street', $this->bestPerformers->getTrackName());
    }

    /** @test */
    function it_returns_array_if_file_exists()
    {
        $result = $this->bestPerformers->getAll();

        $this->assertTrue(is_array($result));
        $this->assertGreaterThan(0, count($result));
        $this->assertArrayHasKey('name', $result[0]);
        $this->assertArrayHasKey('score', $result[0]);
        $this->assertArrayHasKey('car', $result[0]);
        $this->assertArrayHasKey('direction', $result[0]);
    }

    /** @test */
    function returned_arrays_are_properly_sorted_for_circuit_tracks()
    {
        $trackIds = ['1001', '1002', '1003', '1004', '1005', '1006', '1007', '1008'];

        foreach ($trackIds as $trackId) {
            $bp = new BestPerformers(__DIR__ . '/../../NFSUServerData', $trackId);
            $rating = $bp->getAll();
            $this->assertLessThanOrEqual((int)$rating[array_key_last($rating)]['score'], (int)$rating[array_key_first($rating)]['score']);
        }
    }

    /** @test */
    function returned_arrays_are_properly_sorted_for_sprint_tracks()
    {
        $trackIds = ['1102', '1103', '1104', '1105', '1106', '1107', '1108', '1109'];

        foreach ($trackIds as $trackId) {
            $bp = new BestPerformers(__DIR__ . '/../../NFSUServerData', $trackId);
            $rating = $bp->getAll();
            $this->assertLessThanOrEqual((int)$rating[array_key_last($rating)]['score'], (int)$rating[array_key_first($rating)]['score']);
        }
    }

    /** @test */
    function returned_arrays_are_properly_sorted_for_drift_tracks()
    {
        $trackIds = ['1301', '1302', '1303', '1304', '1305', '1306', '1307', '1308'];

        foreach ($trackIds as $trackId) {
            $bp = new BestPerformers(__DIR__ . '/../../NFSUServerData', $trackId);
            $rating = $bp->getAll();
            $this->assertGreaterThanOrEqual((int)$rating[array_key_last($rating)]['score'], (int)$rating[array_key_first($rating)]['score']);
        }
    }

    /** @test */
    function returned_arrays_are_properly_sorted_for_drag_tracks()
    {
        $trackIds = ['1201', '1202', '1206', '1207', '1210', '1214'];

        foreach ($trackIds as $trackId) {
            $bp = new BestPerformers(__DIR__ . '/../../NFSUServerData', $trackId);
            $rating = $bp->getAll();
            $this->assertLessThanOrEqual((int)$rating[array_key_last($rating)]['score'], (int)$rating[array_key_first($rating)]['score']);
        }
    }
}
