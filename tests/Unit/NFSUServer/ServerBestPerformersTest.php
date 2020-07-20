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
        $result = $bp->rating();

        $this->assertTrue(is_array($result));
        $this->assertEmpty($result);
    }

    /** @test */
    function it_returns_valid_track_id()
    {
        $this->assertEquals('1001', $this->bestPerformers->trackId());
    }

    /** @test */
    function it_returns_valid_track_name()
    {
        $this->assertEquals('Market Street', $this->bestPerformers->trackName());
    }

    /** @test */
    function it_returns_array_if_file_exists()
    {
        $result = $this->bestPerformers->rating();

        $this->assertTrue(is_array($result));
        $this->assertGreaterThan(0, count($result));
        $this->assertArrayHasKey('name', $result[0]);
        $this->assertArrayHasKey('score', $result[0]);
        $this->assertArrayHasKey('car', $result[0]);
        $this->assertArrayHasKey('direction', $result[0]);
    }

    /** @test */
    function it_returns_all_circuit_tracks_info()
    {
        $result = $this->bestPerformers->circuits(__DIR__ . '/../../NFSUServerData');

        $this->assertTrue(is_array($result));
        $this->assertCount(8, $result);
    }

    /** @test */
    function it_returns_all_sprint_tracks_info()
    {
        $result = $this->bestPerformers->sprints(__DIR__ . '/../../NFSUServerData');

        $this->assertTrue(is_array($result));
        $this->assertCount(8, $result);
    }

    /** @test */
    function it_returns_all_drift_tracks_info()
    {
        $result = $this->bestPerformers->drifts(__DIR__ . '/../../NFSUServerData');

        $this->assertTrue(is_array($result));
        $this->assertCount(8, $result);
    }

    /** @test */
    function it_returns_all_drag_tracks_info()
    {
        $result = $this->bestPerformers->drags(__DIR__ . '/../../NFSUServerData');

        $this->assertTrue(is_array($result));
        $this->assertCount(6, $result);
    }

    /** @test */
    function returned_arrays_are_properly_sorted_for_circuit_tracks()
    {
        $circuitRatings = $this->bestPerformers->circuits(__DIR__ . '/../../NFSUServerData');

        foreach ($circuitRatings as $rating) {
            ;
            $this->assertLessThanOrEqual((int)$rating[array_key_last($rating)]['score'], (int)$rating[array_key_first($rating)]['score']);
        }
    }

    /** @test */
    function returned_arrays_are_properly_sorted_for_sprint_tracks()
    {
        $sprintRatings = $this->bestPerformers->sprints(__DIR__ . '/../../NFSUServerData');

        foreach ($sprintRatings as $rating) {
            ;
            $this->assertLessThanOrEqual((int)$rating[array_key_last($rating)]['score'], (int)$rating[array_key_first($rating)]['score']);
        }
    }

    /** @test */
    function returned_arrays_are_properly_sorted_for_drift_tracks()
    {
        $driftRatings = $this->bestPerformers->drifts(__DIR__ . '/../../NFSUServerData');

        foreach ($driftRatings as $rating) {
            ;
            $this->assertGreaterThanOrEqual((int)$rating[array_key_last($rating)]['score'], (int)$rating[array_key_first($rating)]['score']);
        }
    }

    /** @test */
    function returned_arrays_are_properly_sorted_for_drag_tracks()
    {
        $dragRatings = $this->bestPerformers->drags(__DIR__ . '/../../NFSUServerData');

        foreach ($dragRatings as $rating) {
            ;
            $this->assertLessThanOrEqual((int)$rating[array_key_last($rating)]['score'], (int)$rating[array_key_first($rating)]['score']);
        }
    }

//    function returned_arrays_are_properly_sorted_for_drag_tracks()
//    {
//        $trackIds = ['1201', '1202', '1206', '1207', '1210', '1214'];
//
//        foreach ($trackIds as $trackId) {
//            $bp = new BestPerformers(__DIR__ . '/../../NFSUServerData', $trackId);
//            $rating = $bp->trackRating();
//            $this->assertLessThanOrEqual((int)$rating[array_key_last($rating)]['score'], (int)$rating[array_key_first($rating)]['score']);
//        }
//    }
}
