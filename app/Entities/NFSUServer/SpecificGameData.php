<?php

namespace App\Entities\NFSUServer;

class SpecificGameData
{
    private $directions;
    private $cars;
    private $tracks;

    public function __construct()
    {
        $this->directions = [
            'Forward',
            'Revers',
        ];

        $this->cars = [
            'WV Golf GTI',
            'Ford Focus',
            'Mazda Miata MX-5',
            'Dodge Neon',
            'Honda Civic',
            'Peugeot 206',
            'Toyota Celica',
            'Mitsubishi Eclipse',
            'Mazda RX-7',
            'Toyota Supra',
            'Honda S2000',
            'Acura RSX',
            'Subaru Impreza',
            'Mitsubishi Lancer',
            'Acura Integra TypeR',
            'Hyundai Tiburon GT',
            'Nissan 350Z',
            'Nissan Sentra SER',
            'Nissan 240SX',
            'Nissan Skyline GTR',
        ];

        $this->tracks = [
            '1001' => 'Market Street',
            '1002' => 'Stadium',
            '1003' => 'Olympic Square',
            '1004' => 'Terminal',
            '1005' => 'Atlantica',
            '1006' => 'Inner City',
            '1007' => 'Port Royal',
            '1008' => 'National Rail',
            '1102' => 'Liberty Gardens',
            '1103' => 'Broadway',
            '1104' => 'Lock Up',
            '1105' => '9th Frey',
            '1106' => 'Bedard Bridge',
            '1107' => 'Spillway',
            '1108' => '1st Ave. Truck Stop',
            '1109' => '7th Sparling',
            '1201' => '14th and Vine Construction',
            '1202' => 'Highway 1',
            '1206' => 'Main Street',
            '1207' => 'Commercial',
            '1210' => '14th and Vine',
            '1214' => 'Main Street Construction',
            '1301' => 'Drift Track 1',
            '1302' => 'Drift Track 2',
            '1303' => 'Drift Track 3',
            '1304' => 'Drift Track 4',
            '1305' => 'Drift Track 5',
            '1306' => 'Drift Track 6',
            '1307' => 'Drift Track 7',
            '1308' => 'Drift Track 8',
        ];
    }

    public function directionsAll(): array
    {
        return $this->directions;
    }

    public function findDirection(int $index): string
    {
        return array_key_exists($index, $this->directions)
            ? $this->directions[$index]
            : 'Unknown direction';
    }

    public function carsAll(): array
    {
        return $this->cars;
    }

    public function findCar(int $index): string
    {
        return array_key_exists($index, $this->cars)
            ? $this->cars[$index]
            : 'Unknown car';
    }

    public function tracksAll(): array
    {
        return $this->tracks;
    }

    public function findTrack(string $index): string
    {
        return array_key_exists($index, $this->tracks)
            ? $this->tracks[$index]
            : 'Unknown track';
    }

    public function tracksCircuit(): array
    {
        return array_slice($this->tracks, 0, 8);
    }

    public function tracksSprint(): array
    {
        return array_slice($this->tracks, 8, 8);
    }

    public function tracksDrag(): array
    {
        return array_slice($this->tracks, 16, 6);
    }

    public function tracksDrift(): array
    {
        return array_slice($this->tracks, 22);
    }
}
