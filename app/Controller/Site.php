<?php

namespace Controller;

use Src\Request;
use Model\Post;
use Src\View;
use Model\User;
use Model\Phone;
use Model\Room;
use Model\Subscriber;
use Model\Subdivision;
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
        $rooms = Room::select('id', 'name')->get();

        if ($request->method === 'POST') {
            Phone::create([
                'number_phone' => $request->number_phone,
                'room' => $request->room_id
            ]);
            return app()->route->redirect('/hello');
        }

        return new View('site.createPhone', [
            'rooms' => $rooms
        ]);
    }

    public function createRoom(Request $request): string
    {
        $subdivisions = Subdivision::select('id', 'name')->get();

        if ($request->method === 'POST') {
            Room::create([
                'name' => $request->name,
                'Type of room' => $request->Type_of_room,
                'subdivision' => $request->subdivision_id
            ]);
            return app()->route->redirect('/hello');
        }

        return new View('site.createRoom', [
            'subdivisions' => $subdivisions
        ]);
    }

    public function attachPhone(Request $request): string
    {

        $subscribers = Subscriber::select('id', 'Surname', 'Name', 'SurnameSecond')->get();
        $phones = Phone::whereNull('subscriber')->select('id', 'number_phone')->get();

        if ($request->method === 'POST') {
            Phone::where('id', $request->phone_id)
                ->update(['subscriber' => $request->subscriber_id]);

            return app()->route->redirect('/hello');
        }

        return new View('site.attachPhone', [
            'subscribers' => $subscribers,
            'numberPhones' => $phones,
        ]);
    }

    public function createSubscribers(Request $request): string
    {
        $subdivisions = Subdivision::select('id', 'name')->get();

        if ($request->method === 'POST') {
            Subscriber::create([
                'Surname' => $request->Surname,
                'Name' => $request->Name,
                'SurnameSecond' => $request->SurnameSecond,
                'Date_of_birth' => $request->Date_of_birth,
                'subdivision' => $request->subdivision_id,
            ]);
            app()->route->redirect('/hello');
        }

        return new View('site.createSubscribers', [
            'subdivisions' => $subdivisions
        ]);
    }

    public function createSubdivision(Request $request): string
    {
        if ($request->method === 'GET') {
            new View('site.createSubdivision');
        }

        if ($request->method === 'POST' ) {
            $subdivision = Subdivision::create([
                'Name' => $request->Name,
                'type_of_unit' => $request->type_of_unit,
            ]);
            app()->route->redirect('/hello');
        }
        return new View('site.createSubdivision');
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
