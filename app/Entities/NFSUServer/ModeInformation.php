<?php

namespace App\Entities\NFSUServer;

/*
 * Class for information of each race mode (Circuit, Sprint, Drift, Drag) and overall
 */
class ModeInformation
{
    public $wins;
    public $loses;
    public $REP;
    public $winsPercent;
    public $discPercent;
    public $avgOppsREP; // average opponents REP
    public $avgOppsRating; // average opponents Rating
}
