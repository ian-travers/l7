<?php

namespace Tests\Unit\NFSUServer;

use App\Entities\NFSUServer\BestPerformers;
use Tests\TestCase;

class ServerBestPerformersTest extends TestCase
{
    public $bestPerformers;

    protected function setUp(): void
    {
        parent::setUp();

        $this->bestPerformers = new BestPerformers(__DIR__ . '/../../NFSUServerData');
    }

    /** @test */
    function it_returns_all_circuit_tracks_info()
    {
        $result = $this->bestPerformers->circuits();

        $this->assertTrue(is_array($result));
        $this->assertCount(8, $result);
    }

    /** @test */
    function it_returns_all_sprint_tracks_info()
    {
        $result = $this->bestPerformers->sprints();

        $this->assertTrue(is_array($result));
        $this->assertCount(8, $result);
    }

    /** @test */
    function it_returns_all_drift_tracks_info()
    {
        $result = $this->bestPerformers->drifts();

        $this->assertTrue(is_array($result));
        $this->assertCount(8, $result);
    }

    /** @test */
    function it_returns_all_drag_tracks_info()
    {
        $result = $this->bestPerformers->drags();

        $this->assertTrue(is_array($result));
        $this->assertCount(6, $result);
    }

    /** @test */
    function returned_arrays_are_properly_sorted_for_circuit_tracks()
    {
        $circuitRatings = $this->bestPerformers->circuits();

        foreach ($circuitRatings as $rating) {
            $this->assertLessThanOrEqual((int)$rating[array_key_last($rating)]['score'], (int)$rating[array_key_first($rating)]['score']);
        }
    }

    /** @test */
    function returned_arrays_are_properly_sorted_for_sprint_tracks()
    {
        $sprintRatings = $this->bestPerformers->sprints();

        foreach ($sprintRatings as $rating) {
            $this->assertLessThanOrEqual((int)$rating[array_key_last($rating)]['score'], (int)$rating[array_key_first($rating)]['score']);
        }
    }

    /** @test */
    function returned_arrays_are_properly_sorted_for_drift_tracks()
    {
        $driftRatings = $this->bestPerformers->drifts();

        foreach ($driftRatings as $rating) {
            $this->assertGreaterThanOrEqual((int)$rating[array_key_last($rating)]['score'], (int)$rating[array_key_first($rating)]['score']);
        }
    }

    /** @test */
    function returned_arrays_are_properly_sorted_for_drag_tracks()
    {
        $dragRatings = $this->bestPerformers->drags();

        foreach ($dragRatings as $rating) {
            $this->assertLessThanOrEqual((int)$rating[array_key_last($rating)]['score'], (int)$rating[array_key_first($rating)]['score']);
        }
    }
}
