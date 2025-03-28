<?php

namespace Controller;

use Model\Subdivision;
use Model\Subscriber;
use Src\Request;
use Src\View;

class phonesBySubdivision
{
    public function phonesBySubdivision(Request $request): string
    {
        $subscribers = Subscriber::with('phones')->get();
        $subdivisions = Subdivision::with('subscribers')->get();

        return new View('site.phonesBySubdivision', [
            'subdivisions' => $subdivisions,
            'subscribers' => $subscribers
        ]);
    }
}