<?php

use Model\User;
use PHPUnit\Framework\TestCase;
use Src\Request;

class SiteTest extends TestCase
{

    //Настройка конфигурации окружения
    protected function setUp(): void
    {
        //Установка переменной среды
        $_SERVER['DOCUMENT_ROOT'] = 'C:\XAMPP8.1\htdocs';

        //Создаем экземпляр приложения
        $GLOBALS['app'] = new Src\Application(new Src\Settings([
            'app' => include $_SERVER['DOCUMENT_ROOT'] . '/config/app.php',
            'db' => include $_SERVER['DOCUMENT_ROOT'] . '/config/db.php',
            'path' => include $_SERVER['DOCUMENT_ROOT'] . '/config/path.php',
        ]));

        //Глобальная функция для доступа к объекту приложения
        if (!function_exists('app')) {
            function app()
            {
                return $GLOBALS['app'];
            }
        }
    }

    /**
     * @dataProvider additionProvider
     */
    public function testSignup(string $httpMethod, array $userData, string $message): void
    {
        //Выбираем занятый логин из базы данных
        if ($userData['login'] === 'OlgaSisAdmin') {
            $userData['login'] = User::get()->first()->login;
        }

        // Создаем заглушку для класса Request.
        $request = $this->createMock(\Src\Request::class);
        // Переопределяем метод all() и свойство method
        $request->expects($this->any())
            ->method('all')
            ->willReturn(array_merge($userData, ['csrf_token' => 'mocked_token']));
        $request->method = $httpMethod;

        //Сохраняем результат работы метода в переменную
        $result = (new \Controller\signup())->signup($request);

        if (!empty($result)) {
            //Проверяем варианты с ошибками валидации
            $message = '/' . preg_quote($message, '/') . '/';
            $this->expectOutputRegex($message);
            return;
        }

        //Проверяем добавился ли пользователь в базу данных
        $this->assertTrue((bool)User::where('login', $userData['login'])->count());
        //Удаляем созданного пользователя из базы данных
        User::where('login', $userData['login'])->delete();

        //Проверяем редирект при успешной регистрации
        $this->assertEquals('/login', $result->getHeader('Location'));
    }

    public static function additionProvider(): array
    {
        return [
            ['GET', ['name' => '','login' => '', 'password' => ''], ''],
            ['POST', [
                'name' => '',
                'login' => '',
                'password' => '',
                'csrf_token' => 'mocked_token',
            ],'Имя обязательно для заполнения', 'Логин обязателен для заполнения', 'Пароль обязателен для заполнения'],
            ['POST', [
                'name' => 'Ольга',
                'login' => 'OlgaSisAdmin%',
                'password' => '23WEsdxc',
                'csrf_token' => 'mocked_token',
            ],'Логин может содержать только латинские буквы'],
            ['POST', [
                'name' => 'Ольга',
                'login' => md5(time()),
                'password' => '23WEsdxc',
                'csrf_token' => 'mocked_token',
            ], 'Location: /login'],
        ];
    }
}