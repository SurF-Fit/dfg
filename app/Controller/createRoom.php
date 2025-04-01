<?php

namespace Controller;

use Helpers\HelperRequest;
use Helpers\HelperResponse;
use Model\Room;
use Model\Subdivision;
use Src\Request;
use Src\View;

class createRoom
{
    public function createRoom(Request $request): string
    {
        if($_SESSION['role'] == 2) {
            $subdivisions = Subdivision::select('id', 'name')->get();

            if ($request->method === 'POST') {
                $errors = HelperRequest::validateRoom($request->all());

                if (empty($errors)) {
                    Room::create([
                        'Name' => $request->name,
                        'Type_of_room' => $request->Type_of_room,
                        'subdivision_id' => $request->subdivision_id
                    ]);
                    HelperResponse::redirectWithMessage('/hello', 'Помещение успешно создано');
                }
                return new View('site.createRoom', [
                    'subdivisions' => $subdivisions,
                    'message' => HelperResponse::validationErrors($errors)
                ]);
            }

            return new View('site.createRoom', ['subdivisions' => $subdivisions]);
        }

        return new View('site.hello');
    }
}