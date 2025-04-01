<?php

namespace Controller;

use Model\Room;
use Src\Request;
use Src\View;

class subscribersByRoom
{
    public function subscribersByRoom(Request $request): string
    {
        if($_SESSION['role'] == 2) {
            $rooms = Room::with([
                'attachedUsers.subscriber',
                'attachedUsers.phone',
                'subdivision'
            ])->get();

            return new View('site.subscribersByRoom', [
                'rooms' => $rooms
            ]);
        }

        return new View('site.hello');
    }
}