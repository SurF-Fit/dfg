<?php

use Model\Subscriber;
use PHPUnit\Framework\TestCase;

class CreateSubscribersTest extends TestCase
{
    protected function setUp(): void
    {
        $_SERVER['DOCUMENT_ROOT'] = 'C:\XAMPP8.1\htdocs';

        $GLOBALS['app'] = new Src\Application(new Src\Settings([
            'app' => include $_SERVER['DOCUMENT_ROOT'] . '/config/app.php',
            'db' => include $_SERVER['DOCUMENT_ROOT'] . '/config/db.php',
            'path' => include $_SERVER['DOCUMENT_ROOT'] . '/config/path.php',
        ]));

        if (!function_exists('app')) {
            function app()
            {
                return $GLOBALS['app'];
            }
        }

        $_SESSION['role'] = 2; // Роль администратора
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
    }

    public static function subscribersProvider(): array
    {
        return [
            ['GET', [], ''], // Просто проверяем отображение формы

            // Тест с пустыми обязательными полями
            ['POST', [
                'surname' => '',
                'name' => '',
                'csrf_token' => 'mocked_token',
            ], 'Фамилия обязательна для заполнения'],

            // Тест с невалидными данными
            ['POST', [
                'surname' => 'Иванов123',
                'name' => 'Иван',
                'csrf_token' => 'mocked_token',
            ], 'Фамилия может содержать только буквы'],

            // Успешное создание
            ['POST', [
                'surname' => 'Кульменев',
                'name' => 'Пётр',
                'surnamesecond' => 'Петрович',
                'date_of_birth' => '1985-05-15',
                'csrf_token' => 'mocked_token',
            ], 'Location: /createSubscribers'],
        ];
    }

    protected function tearDown(): void
    {
        $_SESSION = [];
    }
}