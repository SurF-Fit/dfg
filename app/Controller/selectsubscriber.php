<?php

namespace Controller;

use Model\Subscriber;
use Src\Request;
use Src\View;

class selectsubscriber
{
    public function selectsubscriber(Request $request): string
    {
        $subscribers = Subscriber::all();
        return new View('site.selectsubscriber', ['subscribers' => $subscribers]);
    }
}