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
        $this->$mode->wins = hexdec(self::str2Hex(substr($data, $offset, 4)));
        $this->$mode->REP = hexdec(self::str2Hex(substr($data, $offset + 12, 4)));
        $this->$mode->loses = hexdec(self::str2Hex(substr($data, $offset + 4, 4)));
        $this->$mode->winsPercent = (hexdec(self::str2Hex(substr($data, $offset, 4)))
            + hexdec(self::str2Hex(substr($data, $offset + 4, 4)))
            + hexdec(self::str2Hex(substr($data, $offset + 8, 4)))) == 0
            ? '0%' :
            round((hexdec(self::str2Hex(substr($data, $offset, 4))))
                / (hexdec(self::str2Hex(substr($data, $offset, 4)))
                    + hexdec(self::str2Hex(substr($data, $offset + 4, 4)))
                    + hexdec(self::str2Hex(substr($data, $offset + 8, 4))))
                * 100) . '%';
        $this->$mode->discPercent = (hexdec(self::str2Hex(substr($data, $offset, 4)))
            + hexdec(self::str2Hex(substr($data, $offset + 4, 4)))
            + hexdec(self::str2Hex(substr($data, $offset + 8, 4)))) == 0
            ? '0%' :
            round((hexdec(self::str2Hex(substr($data, $offset + 8, 4))))
                / (hexdec(self::str2Hex(substr($data, $offset, 4)))
                    + hexdec(self::str2Hex(substr($data, $offset + 4, 4)))
                    + hexdec(self::str2Hex(substr($data, $offset + 8, 4))))
                * 100) . '%';
        $this->$mode->avgOppsREP = hexdec(self::str2Hex(substr($data, $offset + 16, 4)));
        $this->$mode->avgOppsRating = hexdec(self::str2Hex(substr($data, $offset + 20, 4)));
    }

    private static function str2Hex($str): string
    {
        $hex = '';
        for ($i = 3; $i >= 0; $i--) {
            if (ord($str[$i]) > 15) {
                $hex .= dechex(ord($str[$i]));
            } else {
                $hex .= '0' . dechex(ord($str[$i]));
            }
        }

        return $hex;
    }
}
