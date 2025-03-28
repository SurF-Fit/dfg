<?php

namespace Controller;

use Model\Subscriber;
use Src\Request;
use Src\View;

class selectPhone
{
    public function selectPhone(Request $request): string
    {
        $subscribers = Subscriber::with('phones')->get();
        return new View('site.selectPhone', ['subscribers' => $subscribers]);
    }
}