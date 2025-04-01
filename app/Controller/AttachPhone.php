<?php

namespace Controller;

use Helpers\HelperResponse;
use Model\AttachedUser;
use Model\Phone;
use Model\Room;
use Model\Subscriber;
use Src\Request;
use Src\View;

class AttachPhone
{
    public function attachPhone(Request $request): string
    {
        if ($_SESSION['role'] == 2) {
            $subscribers = Subscriber::whereNotIn('id', function($query) {
                $query->select('subscriber_id')
                    ->from('attached_users')
                    ->whereNotNull('subscriber_id');
            })->select('id', 'Surname', 'Name', 'SurnameSecond')->get();

            $phones = Phone::whereNotIn('id', function($query) {
                $query->select('phone_id')
                    ->from('attached_users')
                    ->whereNotNull('phone_id');
            })->select('id', 'number_phone')->get();

            $rooms = Room::select('id', 'Name', 'Type_of_room')->get();

            if ($request->method === 'POST') {
                AttachedUser::updateOrCreate(
                    [
                        'subscriber_id' => $request->subscriber_id,
                        'phone_id' => $request->phone_id
                    ],
                    [
                        'room_id' => $request->room_id
                    ]
                );

                HelperResponse::redirectWithMessage('/attachPhone', 'Телефон успешно привязан');
            }

            return new View('site.attachPhone', [
                'subscribers' => $subscribers,
                'phones' => $phones,
                'rooms' => $rooms,
            ]);
        }
        return new View('site.hello');
    }
}