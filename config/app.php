<?php
return [
    //Класс аутентификации
    'auth' => \Src\Auth\Auth::class,
    //Клас пользователя
    'identity'=>\Model\User::class,
    'routeMiddleware' => [
    'auth' => \Middlewares\AuthMiddleware::class,
    ],
    'identityPhone'=>\Model\Phone::class,
    'identityRoom'=>\Model\Room::class,
    'identitySubdivision'=>\Model\Subdivision::class,
];
