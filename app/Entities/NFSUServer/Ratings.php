<?php

namespace App\Entities\NFSUServer;

use DomainException;

class Ratings
{
    /**
     * C++ structure for NFSU Server v2.5 player statistic (default filename stat.dat)
     *
     * struct PlayerStat {
     * char Name[16];
     * int Rating_All;
     * int Wins_All;
     * int Loses_All;
     * int Disc_All;
     * int REP_All;
     * int OppsREP_All;    // average opponents REP
     * int OppsRating_All;    // average opponents Rating
     * int Rating_Circ;
     * int Wins_Circ;
     * int Loses_Circ;
     * int Disc_Circ;
     * int REP_Circ;
     * int OppsREP_Circ;
     * int OppsRating_Circ;
     * int Rating_Sprint;
     * int Wins_Sprint;
     * int Loses_Sprint;
     * int Disc_Sprint;
     * int REP_Sprint;
     * int OppsREP_Sprint;
     * int OppsRating_Sprint;
     * int Rating_Drag;
     * int Wins_Drag;
     * int Loses_Drag;
     * int Disc_Drag;
     * int REP_Drag;
     * int OppsREP_Drag;
     * int OppsRating_Drag;
     * int Rating_Drift;
     * int Wins_Drift;
     * int Loses_Drift;
     * int Disc_Drift;
     * int REP_Drift;
     * int OppsREP_Drift;
     * int OppsRating_Drift;
     * }
     */

    const OFFSET_OVERALL = 20;
    const OFFSET_CIRCUIT = 48;
    const OFFSET_SPRINT = 76;
    const OFFSET_DRAG = 104;
    const OFFSET_DRIFT = 132;

    private $filename;
    private $rawData = [];

    /**
     * Ratings constructor.
     * @param string $filename
     */
    public function __construct(string $filename = 'stat.dat')
    {
        $this->filename = $filename;
        $this->getData();
    }

    private function getData(): void
    {
        if (!file_exists($this->filename)) {
            throw new DomainException('Rankings data was not found.');
        }

        $fileSize = filesize($this->filename);

        $dataArray = [];

        for ($i = 0; $i < $fileSize; $i += 156) {
            $dataArray[] = file_get_contents($this->filename, null, null, $i, 156);
        }

        foreach ($dataArray as $record) {
            $rankingRecord = new RankingRecord();

            $rankingRecord->name = substr(substr($record, 0, 16), 0, strpos(substr($record, 0, 16), "\x0"));
            $rankingRecord->populateMode('overall', $record, self::OFFSET_OVERALL);
            $rankingRecord->populateMode('circuit', $record, self::OFFSET_CIRCUIT);
            $rankingRecord->populateMode('sprint', $record, self::OFFSET_SPRINT);
            $rankingRecord->populateMode('drift', $record, self::OFFSET_DRIFT);
            $rankingRecord->populateMode('drag', $record, self::OFFSET_DRAG);

            array_push($this->rawData, $rankingRecord);
        }
    }

    public function overall(): array
    {
        return $this->modeRanking('overall')->values()->all();
    }

    public function circuit(): array
    {
        return $this->modeRanking('circuit')->values()->all();
    }

    public function sprint(): array
    {
        return $this->modeRanking('sprint')->values()->all();
    }

    public function drift(): array
    {
        return $this->modeRanking('drift')->values()->all();
    }

    public function drag(): array
    {
        return $this->modeRanking('drag')->values()->all();
    }

    private function modeRanking(string $mode)
    {
        $res = [];

        foreach ($this->rawData as $record) {
            $res[] = [
                'name' => $record->name,
                'REP' => $record->$mode->REP,
                'wins' => $record->$mode->wins,
                'loses' => $record->$mode->loses,
                'avg_opps_rating' => $record->$mode->avgOppsRating,
                'avg_opps_REP' => $record->$mode->avgOppsREP,
                'wins_percent' => $record->$mode->winsPercent,
                'disc_percent' => $record->$mode->discPercent,
            ];
        }

        $collection = collect($res);

        return $collection->sortByDesc('REP');
    }

    public function playerInfo(string $name)
    {
        if (!$playerRawData = collect($this->rawData)->firstWhere('name', $name)) {
            throw new DomainException("Player was not found. ({$name})");
        }

        $overallRanking = $this->modeRanking('overall');
        $overallRank = $overallRanking->pluck('name')->search($name);
        $circuitRanking = $this->modeRanking('circuit');
        $circuitRank = $circuitRanking->pluck('name')->search($name);
        $sprintRanking = $this->modeRanking('sprint');
        $sprintRank = $sprintRanking->pluck('name')->search($name);
        $driftRanking = $this->modeRanking('drift');
        $driftRank = $driftRanking->pluck('name')->search($name);
        $dragRanking = $this->modeRanking('drag');
        $dragRank = $dragRanking->pluck('name')->search($name);

        return [
            'name' => $playerRawData->name,
            'overall' => ['rank' => ++$overallRank] + (array)$playerRawData->overall,
            'circuit' => ['rank' => ++$circuitRank] + (array)$playerRawData->circuit,
            'sprint' => ['rank' => ++$sprintRank] + (array)$playerRawData->sprint,
            'drift' => ['rank' => ++$driftRank] + (array)$playerRawData->drift,
            'drag' => ['rank' => ++$dragRank] + (array)$playerRawData->drag,
        ];
    }
}
