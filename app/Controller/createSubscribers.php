<?php

namespace Controller;

use Helpers\HelperRequest;
use Helpers\HelperResponse;
use Model\Subdivision;
use Model\Subscriber;
use Src\Request;
use Src\View;

class createSubscribers
{
    public function createSubscribers(Request $request): string
    {
        if($_SESSION['role'] == 2) {
            $subdivisions = Subdivision::select('id', 'name')->get();

            if ($request->method === 'POST') {
                $errors = HelperRequest::validateSubscriber($request->all());

                if (empty($errors)) {
                    Subscriber::create([
                        'Surname' => $request->Surname,
                        'Name' => $request->Name,
                        'SurnameSecond' => $request->SurnameSecond,
                        'Date_of_birth' => $request->Date_of_birth,
                        'subdivision' => $request->subdivision_id,
                    ]);
                    HelperResponse::redirectWithMessage('/hello', 'Абонент успешно создан');
                }
                return new View('site.createSubscribers', [
                    'subdivisions' => $subdivisions,
                    'message' => HelperResponse::validationErrors($errors)
                ]);
            }

            return new View('site.createSubscribers', ['subdivisions' => $subdivisions]);
        }

        return new View('site.hello');
    }
}