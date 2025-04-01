<?php

namespace Controller;

use Model\Subdivision;
use Model\Subscriber;
use Model\Room;
use Src\Request;
use Src\View;

class SelectSubscriberBySubdivisions
{
    public function selectSubscriberBySubdivisions(Request $request): string
    {
        if ($_SESSION['role'] == 2) {
            // Получаем подразделения с помещениями и привязанными абонентами
            $subdivisions = Subdivision::with(['rooms.attachedUsers.subscriber' => function($query) {
                $query->select('id', 'Surname', 'Name', 'SurnameSecond');
            }])->get();

            // Получаем всех абонентов, не привязанных через AttachedUser
            $unattachedSubscribers = Subscriber::whereDoesntHave('attachedUsers')
                ->select('id', 'Surname', 'Name', 'SurnameSecond')
                ->get();

            return new View('site.selectsubscriberbysubdivisions', [
                'subdivisions' => $subdivisions,
                'unattachedSubscribers' => $unattachedSubscribers
            ]);
        }

        return new View('site.hello');
    }
}