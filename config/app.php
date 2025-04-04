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
    'identitySubscribers'=>\Model\Subscriber::class,
    'routeAppMiddleware' => [
        'csrf' => \Middlewares\CSRFMiddleware::class,
        'trim' => \Middlewares\TrimMiddleware::class,
        'specialChars' => \Middlewares\SpecialCharsMiddleware::class,
        'json' => \Middlewares\JSONMiddleware::class,
    ],
    //Классы провайдеров
    'providers' => [
        'kernel' => \Providers\KernelProvider::class,
        'route' => \Providers\RouteProvider::class,
        'db' => \Providers\DBProvider::class,
        'auth' => \Providers\AuthProvider::class,
    ],
];
