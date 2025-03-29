<?php

namespace Controller;

use Helpers\HelperRequest;
use Helpers\HelperResponse;
use Model\Phone;
use Model\Room;
use Src\Request;
use Src\View;

class createPhone
{
    public function createPhone(Request $request): string
    {

        if($_SESSION['role'] == 2) {
            $rooms = Room::select('id', 'name')->get();

            if ($request->method === 'POST') {
                $errors = HelperRequest::validatePhone($request->all());

                if (empty($errors)) {
                    Phone::create([
                        'number_phone' => $request->number_phone,
                        'room' => $request->room_id
                    ]);
                    HelperResponse::redirectWithMessage('/hello', 'Телефон успешно создан');
                }
                return new View('site.createPhone', [
                    'rooms' => $rooms,
                    'message' => HelperResponse::validationErrors($errors)
                ]);
            }

            return new View('site.createPhone', ['rooms' => $rooms]);
        }

        return new View('site.hello');
    }
}