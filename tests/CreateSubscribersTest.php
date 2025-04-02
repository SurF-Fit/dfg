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


}