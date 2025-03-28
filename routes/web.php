<?php

use Src\Route;

Route::add('GET', '/hello', [Controller\Site::class, 'hello'])
    ->middleware('auth');
Route::add(['GET', 'POST'], '/signup', [Controller\signup::class, 'signup']);
Route::add(['GET', 'POST'], '/login', [Controller\Site::class, 'login']);
Route::add('GET', '/logout', [Controller\Site::class, 'logout']);
Route::add(['GET', 'POST'], '/addsis', [Controller\addsis::class, 'addsis']);
Route::add(['GET', 'POST'], '/createPhone', [Controller\createPhone::class, 'createPhone']);
Route::add(['GET', 'POST'], '/createRoom', [Controller\createRoom::class, 'createRoom']);
Route::add(['GET', 'POST'], '/createSubdivision', [Controller\createSubdivision::class, 'createSubdivision']);
Route::add(['GET', 'POST'], '/createSubscribers', [Controller\createSubscribers::class, 'createSubscribers']);
Route::add(['GET', 'POST'], '/attachPhone', [Controller\attachPhone::class, 'attachPhone']);
Route::add(['GET', 'POST'], '/phonesBySubdivision', [Controller\phonesBySubdivision::class, 'phonesBySubdivision']);
Route::add(['GET', 'POST'], '/selectPhone', [Controller\selectPhone::class, 'selectPhone']);
Route::add(['GET', 'POST'], '/selectsubscriber', [Controller\selectsubscriber::class, 'selectsubscriber']);
Route::add(['GET', 'POST'], '/selectsubscriberbysubdivisions', [Controller\selectsubscriberbysubdivisions::class, 'selectsubscriberbysubdivisions']);
Route::add(['GET', 'POST'], '/subscribersByRoom', [Controller\subscribersByRoom::class, 'subscribersByRoom']);









