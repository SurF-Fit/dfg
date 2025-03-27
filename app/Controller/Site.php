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
use Helpers\HelperRequest;
use Helpers\HelperResponse;

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
                    HelperResponse::redirectWithMessage('/addsis', 'Роль пользователя изменена');
                }
            }
        }

        $users = User::all();
        return new View('site.addsis', ['users' => $users]);
    }

    public function signup(Request $request): string
    {
        if ($request->method === 'POST') {
            $errors = HelperRequest::validateSignup($request->all());

            if (empty($errors)) {
                if (User::create($request->all())) {
                    HelperResponse::redirectWithMessage('/hello', 'Регистрация прошла успешно');
                }
                return new View('site.signup', ['message' => HelperResponse::errorMessage('Ошибка при создании пользователя')]);
            }
            return new View('site.signup', ['message' => HelperResponse::validationErrors($errors)]);
        }
        return new View('site.signup');
    }

    public function createPhone(Request $request): string
    {
        $rooms = Room::select('id', 'name')->get();

        if ($request->method === 'POST') {
            $errors = HelperRequest::validatePhone($request->all());

            if (empty($errors)) {
                Phone::create([
                    'number_phone' => $request->number_phone,
                    'room' => $request->room_id
                ]);
                HelperResponse::redirectWithMessage('/hello', 'Телефон успешно создан');
            }
            return new View('site.createPhone', [
                'rooms' => $rooms,
                'message' => HelperResponse::validationErrors($errors)
            ]);
        }

        return new View('site.createPhone', ['rooms' => $rooms]);
    }

    public function createRoom(Request $request): string
    {
        $subdivisions = Subdivision::select('id', 'name')->get();

        if ($request->method === 'POST') {
            $errors = HelperRequest::validateRoom($request->all());

            if (empty($errors)) {
                Room::create([
                    'Name' => $request->name,
                    'Type_of_room' => $request->Type_of_room,
                    'subdivision' => $request->subdivision_id
                ]);
                HelperResponse::redirectWithMessage('/hello', 'Помещение успешно создано');
            }
            return new View('site.createRoom', [
                'subdivisions' => $subdivisions,
                'message' => HelperResponse::validationErrors($errors)
            ]);
        }

        return new View('site.createRoom', ['subdivisions' => $subdivisions]);
    }

    public function attachPhone(Request $request): string
    {
        $subscribers = Subscriber::select('id', 'Surname', 'Name', 'SurnameSecond')->get();
        $phones = Phone::whereNull('subscriber')->select('id', 'number_phone')->get();

        if ($request->method === 'POST') {
            Phone::where('id', $request->phone_id)
                ->update(['subscriber' => $request->subscriber_id]);

            HelperResponse::redirectWithMessage('/attachPhone', 'Телефон успешно привязан');
        }

        return new View('site.attachPhone', [
            'subscribers' => $subscribers,
            'numberPhones' => $phones,
        ]);
    }

    public function selectPhone(Request $request): string
    {
        $subscribers = Subscriber::with('phones')->get();
        return new View('site.selectPhone', ['subscribers' => $subscribers]);
    }

    public function subscribersByRoom(Request $request): string
    {
        $rooms = Room::with(['phones.subscriber'])->get();
        $subscribers = Subscriber::all();

        return new View('site.subscribersByRoom', [
            'rooms' => $rooms,
            'subscribers' => $subscribers
        ]);
    }

    public function phonesBySubdivision(Request $request): string
    {
        $subscribers = Subscriber::with('phones')->get();
        $subdivisions = Subdivision::with('subscribers')->get();

        return new View('site.phonesBySubdivision', [
            'subdivisions' => $subdivisions,
            'subscribers' => $subscribers
        ]);
    }

    public function selectsubscriber(Request $request): string
    {
        $subscribers = Subscriber::all();
        return new View('site.selectsubscriber', ['subscribers' => $subscribers]);
    }

    public function selectsubscriberbysubdivisions(Request $request): string
    {
        $subscribers = Subscriber::all();
        $subdivisions = Subdivision::with('subscribers')->get();

        return new View('site.selectsubscriberbysubdivisions', [
            'subdivisions' => $subdivisions,
            'subscribers' => $subscribers
        ]);
    }

    public function createSubscribers(Request $request): string
    {
        $subdivisions = Subdivision::select('id', 'name')->get();

        if ($request->method === 'POST') {
            $errors = HelperRequest::validateSubscriber($request->all());

            if (empty($errors)) {
                Subscriber::create([
                    'Surname' => $request->Surname,
                    'Name' => $request->Name,
                    'SurnameSecond' => $request->SurnameSecond,
                    'Date_of_birth' => $request->Date_of_birth,
                    'subdivision' => $request->subdivision_id,
                ]);
                HelperResponse::redirectWithMessage('/hello', 'Абонент успешно создан');
            }
            return new View('site.createSubscribers', [
                'subdivisions' => $subdivisions,
                'message' => HelperResponse::validationErrors($errors)
            ]);
        }

        return new View('site.createSubscribers', ['subdivisions' => $subdivisions]);
    }

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
        HelperResponse::redirectWithMessage('/hello', 'Вы вышли из системы');
    }
}