<?php

namespace Controller;

use Model\Subdivision;
use Model\Subscriber;
use Src\Request;
use Src\View;

class selectsubscriberbysubdivisions
{
    public function selectsubscriberbysubdivisions(Request $request): string
    {
        $subscribers = Subscriber::all();
        $subdivisions = Subdivision::with('subscribers')->get();

        return new View('site.selectsubscriberbysubdivisions', [
            'subdivisions' => $subdivisions,
            'subscribers' => $subscribers
        ]);
    }
}