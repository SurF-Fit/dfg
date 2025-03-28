<?php

namespace Controller;

use Model\Room;
use Model\Subscriber;
use Src\Request;
use Src\View;

class subscribersByRoom
{
    public function subscribersByRoom(Request $request): string
    {
        $rooms = Room::with(['phones.subscriber'])->get();
        $subscribers = Subscriber::all();

        return new View('site.subscribersByRoom', [
            'rooms' => $rooms,
            'subscribers' => $subscribers
        ]);
    }
}