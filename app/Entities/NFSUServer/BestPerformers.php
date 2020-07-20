<?php

namespace App\Entities\NFSUServer;

use DomainException;

class BestPerformers
{
    private $tracks;
    private $cars;
    private $directions;

    private $trackId;
    private $filename;
    private $rawData = [];

    private $circuitIds = ['1001', '1002', '1003', '1004', '1005', '1006', '1007', '1008'];
    private $sprintIds = ['1102', '1103', '1104', '1105', '1106', '1107', '1108', '1109'];
    private $dragIds = ['1201', '1202', '1206', '1207', '1210', '1214'];
    private $driftIds = ['1301', '1302', '1303', '1304', '1305', '1306', '1307', '1308'];

    public function __construct(string $path, string $trackId)
    {
        $spg = new SpecificGameData();
        $this->tracks = $spg->tracksAll();
        $this->cars = $spg->carsAll();
        $this->directions = $spg->directionsAll();

        if (!array_key_exists($trackId, $this->tracks)) {
            throw new DomainException('Unknown track');
        }

        $this->trackId = $trackId;

        // Information for each track is in a separate file
        // Filename is "s{trackId}.dat"
        $this->filename = "{$path}/s{$trackId}.dat";
    }

    public function trackId(): string
    {
        return $this->trackId;
    }

    public function trackName(): string
    {
        return $this->tracks[$this->trackId];
    }

    public function rating(): array
    {
        return !file_exists($this->filename)
            ? []
            : $this->getTrackRating();
    }

    private function getTrackRating(): array
    {
        $tempArray = [];
        for ($i = 0; $i < filesize($this->filename); $i += 28) {
            $tempArray[] = file_get_contents($this->filename, null, null, $i, 28);
        }

        foreach ($tempArray as $record) {
            $name = substr(substr($record, 0, 16), 0, strpos(substr($record, 0, 16), "\x0"));
            $score = hexdec(NFSUServerHelper::str2Hex(substr($record, 16, 4)));
            $car = hexdec(NFSUServerHelper::str2Hex(substr($record, 20, 4)));
            $direction = hexdec(NFSUServerHelper::str2Hex(substr($record, 24, 4)));
            array_push($this->rawData, [
                'name' => $name,
                'score' => $score,
                'car' => $this->cars[$car],
                'direction' => $this->directions[$direction],
            ]);
        }

        // sorting
        $sortArray = [];

        foreach ($this->rawData as $key => $row) {
            $sortArray[$key] = $row['score'];
        }
        if (substr($this->trackId, 1, 1) == '3') {
            // drift
            array_multisort($sortArray, SORT_DESC, $this->rawData);
        } else {
            // circuit, sprint and drag
            array_multisort($sortArray, SORT_ASC, $this->rawData);
        }

        return $this->rawData;
    }

    public function circuits(string $path): array
    {
        return $this->modeAllTracks($path, 'circuit');
    }

    public function sprints(string $path): array
    {
        return $this->modeAllTracks($path, 'sprint');
    }

    public function drifts(string $path): array
    {
        return $this->modeAllTracks($path, 'drift');
    }

    public function drags(string $path): array
    {
        return $this->modeAllTracks($path, 'drag');
    }

    private function modeAllTracks(string $path, string $mode): array
    {
        $idsName = $mode . 'Ids';

        $result = [];

        foreach ($this->$idsName as $trackId) {
            $bp = new self($path, $trackId);
            $result[$trackId] = $bp->rating();
        }

        return $result;
    }
}
