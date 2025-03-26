<?php

use Src\Route;

Route::add('GET', '/hello', [Controller\Site::class, 'hello'])
    ->middleware('auth');
Route::add(['GET', 'POST'], '/signup', [Controller\Site::class, 'signup']);
Route::add(['GET', 'POST'], '/login', [Controller\Site::class, 'login']);
Route::add('GET', '/logout', [Controller\Site::class, 'logout']);
Route::add(['GET', 'POST'], '/addsis', [Controller\Site::class, 'addsis']);
Route::add(['GET', 'POST'], '/createPhone', [Controller\Site::class, 'createPhone']);
Route::add(['GET', 'POST'], '/createRoom', [Controller\Site::class, 'createRoom']);
Route::add(['GET', 'POST'], '/createSubdivision', [Controller\Site::class, 'createSubdivision']);

