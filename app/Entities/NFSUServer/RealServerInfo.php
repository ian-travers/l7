<?php

namespace App\Entities\NFSUServer;

class RealServerInfo implements ServerInterface
{
    private $ip;
    private $port;
    private $isOnline = false;

    private $_serverData;

    private $playersCount;
    private $roomsCount;
    private $onlineTime;
    private $platform;
    private $version;
    private $name;
    private $banCheaters;
    private $playersInRaces;
    private $banNewRooms;
    private $roomsA = []; // Ranked Circuit
    private $roomsB = []; // Ranked Sprint
    private $roomsC = []; // Ranked Drift
    private $roomsD = []; // Ranked Drag
    private $roomsE = []; // Unranked Circuit
    private $roomsF = []; // Unranked Sprint
    private $roomsG = []; // Unranked Drift
    private $roomsH = []; // Unranked Drag

    public function __construct(string $ip = null, string $port = null)
    {
        $this->ip =  $ip ?: config('nfsu-server.ip');
        $this->port = $port ?: config('nfsu-server.port');

        $fp = @fsockopen($this->ip, $this->port, $errno, $errstr, 10);
        if ($fp) {
            $this->isOnline = true;
            $this->_serverData = fgets($fp);
            $this->initFields();
        }
    }

    public function initFields(): void
    {
        /*
         * 0|20|1650849|*nix|2.5|NFSU Cup|0|0|0~~~A.GLOBAL|0|[]A.SANDBOX|0|[]B.GLOBAL|0|[]B.SANDBOX|0|[]C.GLOBAL|0|[]C.SANDBOX|0|[]D.GLOBAL|0|[]D.SANDBOX|0|[]E.GLOBAL|0|[]E.SANDBOX|0|[]E.TOURNEY|0|[]F.GLOBAL|0|[]F.SANDBOX|0|[]F.TOURNEY|0|[]G.GLOBAL|0|[]G.SANDBOX|0|[]G.TOURNEY|0|[]H.GLOBAL|0|[]H.SANDBOX|0|[]H.TOURNEY|0|[]
         */

        if ( strlen(trim($this->_serverData)) > 0 ) {

            // Separate Overall server data and Rooms data
            $data = explode("~~~",$this->_serverData);
            $overall_data = $data[0];
            $rooms_data = $data[1];

            // Get overall server parameters
            $data = explode('|', $overall_data);
            $this->playersCount = $data[0];
            $this->roomsCount = $data[1];
            $this->onlineTime = $data[2];
            $this->platform = $data[3];
            $this->version = $data[4];
            $this->name = $data[5];
            if ($this->version == '2.5') {
                $this->banCheaters = $data[6];
                $this->playersInRaces = $data[7];
                $this->banNewRooms = $data[8];
            }

            // Get Rooms info
            $arr_rooms = explode(']', $rooms_data);
            $rooms = [];

            for ($i = 0; $i < count($arr_rooms); $i++) {
                $temp_data = explode("[", $arr_rooms[$i]);
                $room_data = explode("|", $temp_data[0]);

                if (count($room_data) < 2) {
                    $room_data[1] = 0;
                }

                $room_internal_name = str_replace("\"", "", $room_data[0]);
                $room_type = substr($room_internal_name, 0, 1);
                $room_name = substr($room_internal_name, 2);
                $room_players_count = $room_data[1];

                $players = [];

                if ((int)$room_data[1] > 0)
                {
                    $players_names = explode("|", $temp_data[1]);
                    for ($j = 0; $j < count($players_names); $j++)
                    {
                        if (strlen(trim($players_names[$j]))) {
                            $players[] = $players_names[$j];
                        }
                    }
                }

                $rooms[] = [
                    'type' => $room_type,
                    'name' => $room_name,
                    'count' => $room_players_count,
                    'players' => $players,
                ];
            }

            foreach ($rooms as $room)
            {
                switch ($room['type']) {
                    case "A":
                        array_push($this->roomsA, $room);
                        break;
                    case "B":
                        array_push($this->roomsB, $room);
                        break;
                    case "C":
                        array_push($this->roomsC, $room);
                        break;
                    case "D":
                        array_push($this->roomsD, $room);
                        break;
                    case "E":
                        array_push($this->roomsE, $room);
                        break;
                    case "F":
                        array_push($this->roomsF, $room);
                        break;
                    case "G":
                        array_push($this->roomsG, $room);
                        break;
                    case "H":
                        array_push($this->roomsH, $room);
                        break;
                }
            }
        }
    }

    public function isOnline(): bool
    {
        return $this->isOnline;
    }

    public function playersCount(): int
    {
        return (int)$this->playersCount;
    }

    public function roomsCount(): int
    {
        return (int)$this->roomsCount;
    }

    public function onlineInSeconds(): int
    {
        return $this->onlineTime;
    }

    public function platform(): string
    {
        return $this->platform;
    }

    public function version(): string
    {
        return $this->version;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function isBanCheaters(): ?bool
    {
        return ($this->version >= '2') ? (bool)$this->banCheaters : null;
    }

    public function playersInRaces(): ?int
    {
        return ($this->version >='2') ? (int)$this->playersInRaces : null;
    }

    public function isBanNewRooms(): ?bool
    {
        return ($this->version >= '2') ? (bool)$this->banNewRooms : null;
    }

    public function roomsCircuitRanked(): array
    {
        return $this->roomsA;
    }

    public function roomsSprintRanked(): array
    {
        return $this->roomsB;
    }

    public function roomsDriftRanked(): array
    {
        return $this->roomsC;
    }

    public function roomsDragRanked(): array
    {
        return $this->roomsD;
    }

    public function roomsCircuitUnranked(): array
    {
        return $this->roomsE;
    }

    public function roomsSprintUnranked(): array
    {
        return $this->roomsF;
    }

    public function roomsDriftUnranked(): array
    {
        return $this->roomsG;
    }

    public function roomsDragUnranked(): array
    {
        return $this->roomsH;
    }
}
