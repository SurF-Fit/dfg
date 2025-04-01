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
            if ($request->method === 'POST') {
                $errors = HelperRequest::validatePhone($request->all());

                if (empty($errors)) {
                    Phone::create([
                        'number_phone' => $request->number_phone,
                    ]);
                    HelperResponse::redirectWithMessage('/hello', 'Телефон успешно создан');
                }
                return new View('site.createPhone', [
                    'message' => HelperResponse::validationErrors($errors)
                ]);
            }

            return new View('site.createPhone');
        }

        return new View('site.hello');
    }
}