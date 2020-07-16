<?php

namespace App\Http\Controllers;

use App\Entities\NFSUServer\RealServerInfo;

class NFSUServerController extends Controller
{
    public function monitor()
    {
        $serverInfo = new RealServerInfo();

        return view('frontend.server.monitor', compact('serverInfo'));
    }

    public function rankings()
    {

    }

    public function bestPerformers()
    {

    }

    public function about()
    {

    }
}
