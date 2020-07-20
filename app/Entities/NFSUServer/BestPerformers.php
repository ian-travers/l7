<?php

namespace App\Entities\NFSUServer;

class BestPerformers
{
    private $circuitIds = ['1001', '1002', '1003', '1004', '1005', '1006', '1007', '1008'];
    private $sprintIds = ['1102', '1103', '1104', '1105', '1106', '1107', '1108', '1109'];
    private $dragIds = ['1201', '1202', '1206', '1207', '1210', '1214'];
    private $driftIds = ['1301', '1302', '1303', '1304', '1305', '1306', '1307', '1308'];

    private $path;

    public function __construct(string $path)
    {
        $this->path = $path;
    }

    public function circuits(): array
    {
        return $this->modeAllTracks('circuit');
    }

    public function sprints(): array
    {
        return $this->modeAllTracks('sprint');
    }

    public function drifts(): array
    {
        return $this->modeAllTracks('drift');
    }

    public function drags(): array
    {
        return $this->modeAllTracks('drag');
    }

    private function modeAllTracks(string $mode): array
    {
        $idsName = $mode . 'Ids';

        $result = [];

        foreach ($this->$idsName as $trackId) {
            $bp = new BestPerformersOnTrack($this->path, $trackId);
            $result[$trackId] = $bp->rating();
        }

        return $result;
    }
}
