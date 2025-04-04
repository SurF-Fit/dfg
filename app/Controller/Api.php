<?php

namespace Controller;

use Model\User;
use Src\Request;
use Src\View;

class Api
{
    private $tokenExpiration = 3600;
    private $tokens = [];

    private function validateToken($token): bool
    {
        if (!isset($this->tokens[$token])) {
            return false;
        }

        if ($this->tokens[$token]['expires_at'] < time()) {
            unset($this->tokens[$token]);
            return false;
        }

        return true;
    }

    public function authenticate(Request $request): void
    {
        $data = $request->all();

        // Проверка логина и пароля
        if (empty($data['login']) || empty($data['password'])) {
            (new View())->toJSON(['error' => 'Логин и пароль обязательны.'], 400);
            return;
        }

        // Поиск пользователя в базе данных
        $user = User::where('login', $data['login'])->first();

        // Проверка правильности пароля
        if (!$user || $user->password !== $data['password']) {
            (new View())->toJSON(['error' => 'Неправильный логин или пароль.'], 401);
            return;
        }


        $token = bin2hex(random_bytes(16));
        $this->tokens[$token] = [
            'user_id' => $user->id,
            'expires_at' => time() + $this->tokenExpiration
        ];

        (new View())->toJSON(['token' => $token]);
    }

    public function index(Request $request): void
    {
        if (!$this->validateToken($request->headers['Authorization'] ?? '')) {
            (new View())->toJSON(['error' => 'Неверный или истекший токен.'], 401);
            return;
        }

        $posts = User::all()->toArray();
        (new View())->toJSON($posts);
    }

    public function echo(Request $request): void
    {
        if (!$this->validateToken($request->headers['Authorization'] ?? '')) {
            (new View())->toJSON(['error' => 'Неверный или истекший токен.'], 401);
            return;
        }

        (new View())->toJSON($request->all());
    }
}
