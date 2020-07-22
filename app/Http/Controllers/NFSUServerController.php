<?php

namespace App\Http\Controllers;

use App\Entities\NFSUServer\BestPerformers;
use App\Entities\NFSUServer\Ratings;
use App\Entities\NFSUServer\RealServerInfo;
use App\Entities\NFSUServer\SpecificGameData;
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
            $ratings = new Ratings(config('nfsu-server.path') . '/stat.dat');
        } catch (DomainException $e) {
            return abort(500);
        }

        $overall = array_slice($ratings->overall(), 0, 100);
        $circuit = array_slice($ratings->circuit(), 0, 100);
        $sprint = array_slice($ratings->sprint(), 0, 100);
        $drift = array_slice($ratings->drift(), 0, 100);
        $drag = array_slice($ratings->drag(), 0, 100);

        $playerInfo = [];
        if ($username = request('u')) {
            if (empty($playerInfo = $ratings->playerInfo($username))) {
                return redirect()->refresh()->with('flash', json_encode([
                    'type' => 'warning',
                    'title' => __('flash.warning'),
                    'message' => __('server.player-not-found', ['name' => $username]),
                ]));
            }
        }

        return view('frontend.server.ratings', compact('overall', 'circuit', 'sprint', 'drift', 'drag', 'playerInfo'));
    }

    public function bestPerformers()
    {
        $bp = new BestPerformers(config('nfsu-server.path'));

        $allTracks = $bp->all();

        $sgd = new SpecificGameData();

        return view('frontend.server.best-performers', compact('allTracks', 'sgd'));
    }

    public function about()
    {
        //
    }
}
