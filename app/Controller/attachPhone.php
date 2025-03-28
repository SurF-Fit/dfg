<?php

namespace Controller;

use Helpers\HelperResponse;
use Model\Phone;
use Model\Subscriber;
use Src\Request;
use Src\View;

class attachPhone
{
    public function attachPhone(Request $request): string
    {
        $subscribers = Subscriber::select('id', 'Surname', 'Name', 'SurnameSecond')->get();
        $phones = Phone::whereNull('subscriber')->select('id', 'number_phone')->get();

        if ($request->method === 'POST') {
            Phone::where('id', $request->phone_id)
                ->update(['subscriber' => $request->subscriber_id]);

            HelperResponse::redirectWithMessage('/attachPhone', 'Телефон успешно привязан');
        }

        return new View('site.attachPhone', [
            'subscribers' => $subscribers,
            'numberPhones' => $phones,
        ]);
    }
}