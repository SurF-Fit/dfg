<?php

use Src\Route;

Route::add('GET', '/', [Controller\Api::class, 'index']) ->middleware('auth');;
Route::add('POST', '/echo', [Controller\Api::class, 'echo']) ->middleware('auth');;
Route::add('POST', '/authenticate', [Controller\Api::class, 'authenticate']);
