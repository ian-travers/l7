<?php

namespace App\Entities\NFSUServer;

class BestPerformers
{
    private $path;

    public function __construct(string $path)
    {
        $this->path = $path;
    }

    public function all()
    {
        $sgd = new SpecificGameData();

        $result = [];

        foreach ($sgd->tracksAll() as $trackId => $name) {
            $bp = new BestPerformersOnTrack($this->path, $trackId);
            $result[$trackId] = $bp->rating();
        }

        return $result;
    }

    public function circuits(): array
    {
        return array_slice($this->all(), 0, 8);
    }

    public function sprints(): array
    {
        return array_slice($this->all(), 8, 8);
    }

    public function drags(): array
    {
        return array_slice($this->all(), 16, 6);
    }

    public function drifts(): array
    {
        return array_slice($this->all(), 22);
    }
}
