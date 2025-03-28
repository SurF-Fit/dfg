<?php

namespace Controller;

use Helpers\HelperRequest;
use Helpers\HelperResponse;
use Model\Subdivision;
use Src\Request;
use Src\View;

class createSubdivision
{
    public function createSubdivision(Request $request): string
    {
        if ($request->method === 'POST') {
            $errors = HelperRequest::validateSubdivision($request->all());

            if (empty($errors)) {
                Subdivision::create([
                    'Name' => $request->Name,
                    'type_of_unit' => $request->type_of_unit,
                ]);
                HelperResponse::redirectWithMessage('/hello', 'Подразделение успешно создано');
            }
            return new View('site.createSubdivision', [
                'message' => HelperResponse::validationErrors($errors)
            ]);
        }
        return new View('site.createSubdivision');
    }
}