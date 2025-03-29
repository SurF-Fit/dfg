<?php

namespace Controller;

use Model\User;
use Src\Request;
use Model\Post;
use Src\Session;
use Src\View;
use Src\Auth\Auth;
use Helpers\HelperRequest;
use Helpers\HelperResponse;

class Site
{
    public function hello(): string
    {
        return new View('site.hello', ['message' => 'Давай работать!!!']);
    }

    public function login(Request $request): string
    {
        if ($request->method === 'GET') {
            return new View('site.login');
        }

        $errors = HelperRequest::validateLogin($request->all());

        if (empty($errors) && Auth::attempt($request->all())) {
            HelperResponse::redirectWithMessage('/hello', 'Вы успешно авторизованы');
        }

        $message = !empty($errors)
            ? HelperResponse::validationErrors($errors)
            : HelperResponse::errorMessage('Неправильные логин или пароль');

        return new View('site.login', ['message' => $message]);
    }

    public function logout(): void
    {
        Auth::logout();
        session_destroy();
        HelperResponse::redirectWithMessage('/hello', 'Вы вышли из системы');
    }
}