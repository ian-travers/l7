<?php

namespace Tests\Unit\NFSUServer;

use App\Entities\NFSUServer\Ratings;
use Tests\TestCase;

class RankingsTest extends TestCase
{
    public $rankings;

    protected function setUp(): void
    {
        parent::setUp();

        $this->rankings = new Ratings(__DIR__ . '/../../NFSUServerData/stat.dat');
    }

    /** @test */
    function it_returns_overall_ranking()
    {
        $ranking = $this->rankings->overall();

        $this->assertTrue(is_array($ranking));
        $this->assertGreaterThan(0, count($ranking));

        $this->assertArrayHasKey('name', $ranking[0]);
        $this->assertArrayHasKey('REP', $ranking[0]);
        $this->assertArrayHasKey('wins', $ranking[0]);
        $this->assertArrayHasKey('loses', $ranking[0]);
        $this->assertArrayHasKey('avg_opps_rating', $ranking[0]);
        $this->assertArrayHasKey('avg_opps_REP', $ranking[0]);
        $this->assertArrayHasKey('wins_percent', $ranking[0]);
        $this->assertArrayHasKey('disc_percent', $ranking[0]);
    }

    /** @test */
    function it_returns_circuit_ranking()
    {
        $ranking = $this->rankings->circuit();

        $this->assertTrue(is_array($ranking));
        $this->assertGreaterThan(0, count($ranking));

        $this->assertArrayHasKey('name', $ranking[0]);
        $this->assertArrayHasKey('REP', $ranking[0]);
        $this->assertArrayHasKey('wins', $ranking[0]);
        $this->assertArrayHasKey('loses', $ranking[0]);
        $this->assertArrayHasKey('avg_opps_rating', $ranking[0]);
        $this->assertArrayHasKey('avg_opps_REP', $ranking[0]);
        $this->assertArrayHasKey('wins_percent', $ranking[0]);
        $this->assertArrayHasKey('disc_percent', $ranking[0]);
    }

    /** @test */
    function it_returns_sprint_ranking()
    {
        $ranking = $this->rankings->sprint();

        $this->assertTrue(is_array($ranking));
        $this->assertGreaterThan(0, count($ranking));

        $this->assertArrayHasKey('name', $ranking[0]);
        $this->assertArrayHasKey('REP', $ranking[0]);
        $this->assertArrayHasKey('wins', $ranking[0]);
        $this->assertArrayHasKey('loses', $ranking[0]);
        $this->assertArrayHasKey('avg_opps_rating', $ranking[0]);
        $this->assertArrayHasKey('avg_opps_REP', $ranking[0]);
        $this->assertArrayHasKey('wins_percent', $ranking[0]);
        $this->assertArrayHasKey('disc_percent', $ranking[0]);
    }

    /** @test */
    function it_returns_drift_ranking()
    {
        $ranking = $this->rankings->drift();

        $this->assertTrue(is_array($ranking));
        $this->assertGreaterThan(0, count($ranking));

        $this->assertArrayHasKey('name', $ranking[0]);
        $this->assertArrayHasKey('REP', $ranking[0]);
        $this->assertArrayHasKey('wins', $ranking[0]);
        $this->assertArrayHasKey('loses', $ranking[0]);
        $this->assertArrayHasKey('avg_opps_rating', $ranking[0]);
        $this->assertArrayHasKey('avg_opps_REP', $ranking[0]);
        $this->assertArrayHasKey('wins_percent', $ranking[0]);
        $this->assertArrayHasKey('disc_percent', $ranking[0]);
    }

    /** @test */
    function it_returns_drag_ranking()
    {
        $ranking = $this->rankings->drag();

        $this->assertTrue(is_array($ranking));
        $this->assertGreaterThan(0, count($ranking));

        $this->assertArrayHasKey('name', $ranking[0]);
        $this->assertArrayHasKey('REP', $ranking[0]);
        $this->assertArrayHasKey('wins', $ranking[0]);
        $this->assertArrayHasKey('loses', $ranking[0]);
        $this->assertArrayHasKey('avg_opps_rating', $ranking[0]);
        $this->assertArrayHasKey('avg_opps_REP', $ranking[0]);
        $this->assertArrayHasKey('wins_percent', $ranking[0]);
        $this->assertArrayHasKey('disc_percent', $ranking[0]);
    }

    /** @test */
    function it_returns_existing_player_ranking_info()
    {
        $playerInfo = $this->rankings->playerInfo('FLASH');

        $this->assertEquals('FLASH', $playerInfo['name']);

        $this->assertEquals(1, $playerInfo['overall']['rank']);
        $this->assertEquals(919, $playerInfo['overall']['wins']);
        $this->assertEquals(248, $playerInfo['overall']['loses']);
        $this->assertEquals(7788250, $playerInfo['overall']['REP']);
        $this->assertEquals('77%', $playerInfo['overall']['winsPercent']);
        $this->assertEquals('3%', $playerInfo['overall']['discPercent']);
        $this->assertEquals(90979, $playerInfo['overall']['avgOppsREP']);
        $this->assertEquals(157, $playerInfo['overall']['avgOppsRating']);

        $this->assertEquals(1, $playerInfo['circuit']['rank']);
        $this->assertEquals(226, $playerInfo['circuit']['wins']);
        $this->assertEquals(57, $playerInfo['circuit']['loses']);
        $this->assertEquals(14056629, $playerInfo['circuit']['REP']);
        $this->assertEquals('75%', $playerInfo['circuit']['winsPercent']);
        $this->assertEquals('6%', $playerInfo['circuit']['discPercent']);
        $this->assertEquals(202634, $playerInfo['circuit']['avgOppsREP']);
        $this->assertEquals(403, $playerInfo['circuit']['avgOppsRating']);

        $this->assertEquals(1, $playerInfo['sprint']['rank']);
        $this->assertEquals(175, $playerInfo['sprint']['wins']);
        $this->assertEquals(49, $playerInfo['sprint']['loses']);
        $this->assertEquals(626204, $playerInfo['sprint']['REP']);
        $this->assertEquals('76%', $playerInfo['sprint']['winsPercent']);
        $this->assertEquals('3%', $playerInfo['sprint']['discPercent']);
        $this->assertEquals(439, $playerInfo['sprint']['avgOppsREP']);
        $this->assertEquals(501, $playerInfo['sprint']['avgOppsRating']);

        $this->assertEquals(1, $playerInfo['drift']['rank']);
        $this->assertEquals(243, $playerInfo['drift']['wins']);
        $this->assertEquals(46, $playerInfo['drift']['loses']);
        $this->assertEquals(15852142, $playerInfo['drift']['REP']);
        $this->assertEquals('82%', $playerInfo['drift']['winsPercent']);
        $this->assertEquals('3%', $playerInfo['drift']['discPercent']);
        $this->assertEquals(162062, $playerInfo['drift']['avgOppsREP']);
        $this->assertEquals(259, $playerInfo['drift']['avgOppsRating']);

        $this->assertEquals(4, $playerInfo['drag']['rank']);
        $this->assertEquals(275, $playerInfo['drag']['wins']);
        $this->assertEquals(96, $playerInfo['drag']['loses']);
        $this->assertEquals(618026, $playerInfo['drag']['REP']);
        $this->assertEquals('74%', $playerInfo['drag']['winsPercent']);
        $this->assertEquals('0%', $playerInfo['drag']['discPercent']);
        $this->assertEquals(108, $playerInfo['drag']['avgOppsREP']);
        $this->assertEquals(182, $playerInfo['drag']['avgOppsRating']);
    }

    /** @test */
    function it_returns_empty_array_when_unknown_player_name_provided()
    {
        $playerInfo = $this->rankings->playerInfo('NOBODY|&');

        $this->assertTrue(is_array($playerInfo));
        $this->assertCount(0, $playerInfo);
    }
}
