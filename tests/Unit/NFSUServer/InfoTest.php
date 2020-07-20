<?php

namespace Tests\Unit\NFSUServer;

use App\Entities\NFSUServer\FakeServerInfo;
use App\Entities\NFSUServer\RealServerInfo;
use Tests\TestCase;

class InfoTest extends TestCase
{
    public $server;

    protected function setUp(): void
    {
        parent::setUp();

        $this->server = new FakeServerInfo();
    }

    /** @test */
    function it_online_with_valid_ip_and_port()
    {
        $this->assertTrue($this->server->isOnline());
    }

    /** @test */
    function it_offline_with_invalid_ip_or_port()
    {
        /** @var RealServerInfo $info */
        $info = new RealServerInfo('127.0.0.1');

        $this->assertFalse($info->isOnline());

        $info = new RealServerInfo(null, '10999');

        $this->assertFalse($info->isOnline());
    }

    /** @test */
    function online_server_returns_status()
    {
        $this->assertTrue(is_bool($this->server->isOnline()));
    }

    /** @test */
    function online_server_returns_players_count()
    {
       $this->assertTrue(is_integer($this->server->playersCount()));
    }

    /** @test */
    function online_server_returns_rooms_count()
    {
        $this->assertTrue(is_integer($this->server->roomsCount()));
    }

    /** @test */
    function online_server_returns_time_in_seconds()
    {
        $this->assertTrue(is_integer($this->server->onlineInSeconds()));
    }

    /** @test */
    function online_server_returns_platform()
    {
        $this->assertTrue(is_string($this->server->platform()));
    }

    /** @test */
    function online_server_returns_version()
    {
        $this->assertTrue(is_string($this->server->version()));
    }

    /** @test */
    function online_server_returns_name()
    {
        $this->assertTrue(is_string($this->server->name()));
    }

    /** @test */
    function online_server_returns_is_ban_cheaters()
    {
        $this->server->version() >= '2'
            ? $this->assertTrue(is_bool($this->server->isBanCheaters()))
            : $this->assertNull($this->server->isBanCheaters());
    }

    /** @test */
    function online_server_returns_is_ban_new_rooms()
    {
        $this->server->version() >= '2'
            ? $this->assertTrue(is_bool($this->server->isBanNewRooms()))
            : $this->assertNull($this->server->isBanNewRooms());
    }

    /** @test */
    function online_server_returns_players_in_race()
    {
        $this->server->version() >= '2'
            ? $this->assertTrue(is_integer($this->server->playersInRaces()))
            : $this->assertNull($this->server->playersInRaces());
    }

    /** @test */
    function online_server_returns_circuit_ranked_rooms_list()
    {
        $this->assertTrue(is_array($this->server->roomsCircuitRanked()));
    }

    /** @test */
    function online_server_returns_circuit_unranked_rooms_list()
    {
        $this->assertTrue(is_array($this->server->roomsCircuitUnranked()));
    }

    /** @test */
    function online_server_returns_sprint_ranked_rooms_list()
    {
        $this->assertTrue(is_array($this->server->roomsSprintRanked()));
    }

    /** @test */
    function online_server_returns_sprint_unranked_rooms_list()
    {
        $this->assertTrue(is_array($this->server->roomsSprintUnranked()));
    }

    /** @test */
    function online_server_returns_drift_ranked_rooms_list()
    {
        $this->assertTrue(is_array($this->server->roomsDriftRanked()));
    }

    /** @test */
    function online_server_returns_drift_unranked_rooms_list()
    {
        $this->assertTrue(is_array($this->server->roomsDriftUnranked()));
    }

    /** @test */
    function online_server_returns_drag_ranked_rooms_list()
    {
        $this->assertTrue(is_array($this->server->roomsDragRanked()));
    }

    /** @test */
    function online_server_returns_drag_unranked_rooms_list()
    {
        $this->assertTrue(is_array($this->server->roomsDragUnranked()));
    }
}
