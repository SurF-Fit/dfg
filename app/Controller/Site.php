<?php

namespace Controller;

use Src\Request;
use Model\Post;
use Src\View;
use Model\User;
use Model\Phone;
use Model\Room;
use Src\Auth\Auth;


class Site
{
    public function index(Request $request): string
    {
        $posts = Post::where('id', $request->id)->get();
        return (new View())->render('site.post', ['posts' => $posts]);
    }

    public function hello(): string
    {
        return new View('site.hello', ['message' => 'Давай работать!!!']);
    }

    public function addsis(Request $request): string
    {
        if ($request->method === 'POST') {
            $data = $request->all();
            if (isset($data['user_id']) && isset($data['role'])) {
                $user = User::find($data['user_id']);

                if ($user) {
                    switch ($data['role']) {
                        case 'make_admin':
                            $user->role = 1;
                            break;
                        case 'make_sysadmin':
                            $user->role = 2;
                            break;
                        case 'make_user':
                            $user->role = 0;
                            break;
                    }
                    $user->save();
                }
            }
        }

        $users = User::all();
        return new View('site.addsis', ['users' => $users]);
    }

    public function signup(Request $request): string
    {
        if ($request->method === 'POST' && User::create($request->all())) {
            app()->route->redirect('/hello');
        }
        return new View('site.signup');
    }

    public function createPhone(Request $request): string
    {
        if ($request->method === 'GET') {
            new View('site.createPhone');
        }

        if ($request->method === 'POST' ) {
            $phone = Phone::create(['number_phone' => $request->number_phone]);
            app()->route->redirect('/hello');
        }
        return new View('site.createPhone');
    }

    public function createRoom(Request $request): string
    {
        if ($request->method === 'GET') {
            new View('site.createRoom');
        }

        if ($request->method === 'POST' ) {
            $phone = Room::create([
                'Name' => $request->Name,
                'Type of room' => $request->Type_of_room
                ]);
            app()->route->redirect('/hello');
        }
        return new View('site.createRoom');
    }

    public function login(Request $request): string
    {
        //Если просто обращение к странице, то отобразить форму
        if ($request->method === 'GET') {
            return new View('site.login');
        }
        //Если удалось аутентифицировать пользователя, то редирект
        if (Auth::attempt($request->all())) {
            app()->route->redirect('/hello');
        }
        //Если аутентификация не удалась, то сообщение об ошибке
        return new View('site.login', ['message' => 'Неправильные логин или пароль']);
    }

    public function logout(): void
    {
        Auth::logout();
        app()->route->redirect('/hello');
    }

}
