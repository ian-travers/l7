<?php

namespace App\Http\Controllers;

use App\Entities\NFSUServer\Ratings;
use App\Entities\NFSUServer\RealServerInfo;
use DomainException;

class NFSUServerController extends Controller
{
    public function monitor()
    {
        $serverInfo = new RealServerInfo();

        return view('frontend.server.monitor', compact('serverInfo'));
    }

    public function ratings()
    {
        try {
            $ratings = new Ratings(__DIR__ . '/../../../tests/NFSUServerData/stat.dat');
        } catch (DomainException $e) {
            return abort(500);
        }

        $overall = array_slice($ratings->overall(), 0, 100);
        $circuit = array_slice($ratings->circuit(), 0, 100);
        $sprint = array_slice($ratings->sprint(), 0, 100);
        $drift = array_slice($ratings->drift(), 0, 100);
        $drag = array_slice($ratings->drag(), 0, 100);

        return view('frontend.server.ratings', compact('overall', 'circuit', 'sprint', 'drift', 'drag'));
    }

    public function bestPerformers()
    {
        //
    }

    public function about()
    {
        //
    }
}
