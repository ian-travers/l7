<?php

namespace App\Entities\NFSUServer;

use DomainException;

class BestPerformersOnTrack
{
    private $tracks;
    private $cars;
    private $directions;

    private $trackId;
    private $filename;
    private $rawData = [];

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

    public function isDriftTrack(): bool
    {
        return substr($this->trackId, 1, 1) == '3';
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
                'result_for_humans' => $this->isDriftTrack() ? number_format($score, 0, '', ' ') : $this->toMinSec($score),
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

    private function toMinSec(int $milliseconds = 0): string
    {
        $result = '';
        if ($milliseconds) {
            $minutes = floor($milliseconds / 60000);
            $seconds = floor(($milliseconds - ($minutes * 60000)) / 1000);
            $mseconds = $milliseconds % 1000;

            $minutes ? $result .= (string)$minutes . ':' : null;
            $seconds < 10 ? $result .= '0' . (string)$seconds . '.' : $result .= (string)$seconds . '.';
            $mseconds < 100 ? ($mseconds ? $result .= '0' . (string)$mseconds : $result .= '000') : $result .= (string)$mseconds;
        }

        return substr($result, 0, strlen($result) - 1);
    }
}
