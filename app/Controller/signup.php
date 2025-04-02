<?php

namespace Controller;

use Helpers\HelperRequest;
use Helpers\HelperResponse;
use Model\User;
use Src\Request;
use Src\View;

class signup
{
    public function signup(Request $request): string
    {
        if ($request->method === 'POST') {
            $errors = HelperRequest::validateSignup($request->all());

            if (empty($errors)) {
                if (User::create($request->all())) {
                    app()->route->redirect('/login');
                    return '';
                }
                return new View('site.signup', ['message' => HelperResponse::errorMessage('Ошибка при создании пользователя')]);
            }
            return new View('site.signup', ['message' => HelperResponse::validationErrors($errors)]);
        }
        return new View('site.signup');
    }
}