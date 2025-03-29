<?php

namespace Controller;

use Model\Subscriber;
use Src\Request;
use Src\View;

class selectsubscriber
{
    public function selectsubscriber(Request $request): string
    {
        if($_SESSION['role'] == 2) {
            $subscribers = Subscriber::all();
            return new View('site.selectsubscriber', ['subscribers' => $subscribers]);
        }

        return new View('site.hello');
    }
}