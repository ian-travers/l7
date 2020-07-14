<?php

namespace App\Entities\NFSUServer;

class FakeServerInfo implements ServerInterface
{
    use ServerRoutines;

    public function __construct()
    {
        $this->isOnline = true;
        $this->initFields();
    }

    public function initFields()
    {
        $this->playersCount = 15;
        $this->roomsCount = 8;
        $this->onlineTime = 999;
        $this->platform = 'UNI';
        $this->version = '2';
        $this->name = 'FAKE';
        $this->banCheaters = false;
        $this->playersInRaces = 5;
        $this->banNewRooms = false;
    }
}
