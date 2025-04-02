<?php

use Model\User;
use Model\Subscriber;
use PHPUnit\Framework\TestCase;

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
        $this->assertContains($message, xdebug_get_headers());
    }

    public static function additionProvider(): array
    {
        return [
            ['GET', ['name' => '','login' => '', 'password' => ''], ''],
            ['POST', [
                'name' => '',
                'login' => '',
                'password' => '',
            ],'Имя обязательно для заполнения', 'Логин обязателен для заполнения', 'Пароль обязателен для заполнения'],
            ['POST', [
                'name' => 'Ольга',
                'login' => 'OlgaSisAdmin%',
                'password' => '23WEsdxc',
            ],'Логин может содержать только латинские буквы'],
            ['POST', [
                'name' => 'Ольга',
                'login' => md5(time()),
                'password' => '23WEsdxc',
            ], 'Location: /login'],
        ];
    }


    /**
     * @dataProvider additionProviderLogin
     */
    public function testLogin(string $httpMethod, array $userData, string $message): void
    {

        // Создаем заглушку для класса Request.
        $request = $this->createMock(\Src\Request::class);
        // Переопределяем метод all() и свойство method
        $request->expects($this->any())
            ->method('all')
            ->willReturn(array_merge($userData, ['csrf_token' => 'mocked_token']));
        $request->method = $httpMethod;

        //Сохраняем результат работы метода в переменную
        $result = (new \Controller\Site())->login($request);

        if (!empty($result)) {
            //Проверяем варианты с ошибками валидации
            $message = '/' . preg_quote($message, '/') . '/';
            $this->expectOutputRegex($message);
            return;
        }

        //Проверяем редирект при успешной регистрации
        $this->assertContains($message, xdebug_get_headers());
    }

    public static function additionProviderLogin(): array
    {
        return [
            ['GET', ['login' => '', 'password' => ''], ''],
            ['POST', [
                'login' => 'OlgaSisAdmin',
                'password' => '23WEsdxc',
            ],'Location: /hello'],
        ];
    }

    /**
     * @dataProvider subscribersProvider
     */
    public function testCreateSubscribers(string $httpMethod, array $subscriberData, string $message): void
    {

        $request = $this->createMock(\Src\Request::class);

        $request->expects($this->any())
            ->method('all')
            ->willReturn(array_merge($subscriberData, ['csrf_token' => 'mocked_token']));
        $request->method = $httpMethod;

        $result = (new \Controller\createSubscribers())->createSubscribers($request);

        if (!empty($result)) {
            $message = '/' . preg_quote($message, '/') . '/';
            $this->expectOutputRegex($message);
            return;
        }

        $this->assertContains($message, xdebug_get_headers());

        // Очистка после успешного создания
        if ($httpMethod === 'POST' && $message === 'Location: /createSubscribers') {
            Subscriber::where('Surname', $subscriberData['Surname'])
                ->where('Name', $subscriberData['Name'])
                ->delete();
        }
    }

    public static function subscribersProvider(): array
    {
        return [
            ['GET', [], ''], // Просто проверяем отображение формы

            // Тест с пустыми обязательными полями
            ['POST', [
                'surname' => '',
                'name' => ''
            ], 'Фамилия обязательна для заполнения'],

            // Тест с невалидными данными
            ['POST', [
                'surname' => 'Иванов123',
                'name' => 'Иван'
            ], 'Фамилия может содержать только буквы'],

            // Успешное создание
            ['POST', [
                'surname' => 'Кульменев',
                'name' => 'Пётр',
                'surnamesecond' => 'Петрович',
                'date_of_birth' => '1985-05-15',
                'image_path' => 'uploads/subscribers/test.jpg'
            ], 'Location: /createSubscribers'],
        ];
    }
}