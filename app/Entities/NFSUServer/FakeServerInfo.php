<?php

namespace App\Entities\NFSUServer;

use Carbon\Carbon;

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
        $this->banCheaters = true;
        $this->playersInRaces = 5;
        $this->banNewRooms = true;
        $this->ip = '1.0.0.0';

        $players = ['newbie', 'oldie'];

        $this->roomsA[] = [
            'type' => 'A',
            'name' => 'FAKE_ROOM',
            'count' => '2',
            'players' => $players
        ];
    }

    public function onlineTimeForHumans(): string
    {
        $d = Carbon::now();
        $d->subSeconds($this->onlineTime);

        return __('server.online-since') . ' ' . $d->format('d.m.Y') . ' (' . $d->longAbsoluteDiffForHumans() . ').';
    }
}
