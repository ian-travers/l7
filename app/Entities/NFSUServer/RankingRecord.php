<?php

namespace App\Entities\NFSUServer;

class RankingRecord
{
    public $name;
    public $overall;
    public $circuit;
    public $sprint;
    public $drift;
    public $drag;

    public function __construct()
    {
        $this->overall = new ModeInformation();
        $this->circuit = new ModeInformation();
        $this->sprint = new ModeInformation();
        $this->drift = new ModeInformation();
        $this->drag = new ModeInformation();
    }

    public function populateMode(string $mode, string $data, int $offset): void
    {
        $this->$mode->wins = hexdec(NFSUServerHelper::str2Hex(substr($data, $offset, 4)));
        $this->$mode->REP = hexdec(NFSUServerHelper::str2Hex(substr($data, $offset + 12, 4)));
        $this->$mode->loses = hexdec(NFSUServerHelper::str2Hex(substr($data, $offset + 4, 4)));
        $this->$mode->winsPercent = (hexdec(NFSUServerHelper::str2Hex(substr($data, $offset, 4)))
            + hexdec(NFSUServerHelper::str2Hex(substr($data, $offset + 4, 4)))
            + hexdec(NFSUServerHelper::str2Hex(substr($data, $offset + 8, 4)))) == 0
            ? '0%' :
            round((hexdec(NFSUServerHelper::str2Hex(substr($data, $offset, 4))))
                / (hexdec(NFSUServerHelper::str2Hex(substr($data, $offset, 4)))
                    + hexdec(NFSUServerHelper::str2Hex(substr($data, $offset + 4, 4)))
                    + hexdec(NFSUServerHelper::str2Hex(substr($data, $offset + 8, 4))))
                * 100) . '%';
        $this->$mode->discPercent = (hexdec(NFSUServerHelper::str2Hex(substr($data, $offset, 4)))
            + hexdec(NFSUServerHelper::str2Hex(substr($data, $offset + 4, 4)))
            + hexdec(NFSUServerHelper::str2Hex(substr($data, $offset + 8, 4)))) == 0
            ? '0%' :
            round((hexdec(NFSUServerHelper::str2Hex(substr($data, $offset + 8, 4))))
                / (hexdec(NFSUServerHelper::str2Hex(substr($data, $offset, 4)))
                    + hexdec(NFSUServerHelper::str2Hex(substr($data, $offset + 4, 4)))
                    + hexdec(NFSUServerHelper::str2Hex(substr($data, $offset + 8, 4))))
                * 100) . '%';
        $this->$mode->avgOppsREP = hexdec(NFSUServerHelper::str2Hex(substr($data, $offset + 16, 4)));
        $this->$mode->avgOppsRating = hexdec(NFSUServerHelper::str2Hex(substr($data, $offset + 20, 4)));
    }
}
