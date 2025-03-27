<?php

namespace Helpers;

class HelperRequest
{
    public static function validateSignup(array $data): array
    {
        $errors = [];

        if (empty($data['name'])) {
            $errors['name'] = 'Имя обязательно для заполнения';
        } elseif (strlen($data['name']) > 255) {
            $errors['name'] = 'Имя не должно превышать 255 символов';
        }

        if (empty($data['login'])) {
            $errors['login'] = 'Логин обязателен для заполнения';
        } elseif (strlen($data['login']) > 50) {
            $errors['login'] = 'Логин не должен превышать 50 символов';
        }

        if (empty($data['password'])) {
            $errors['password'] = 'Пароль обязателен для заполнения';
        } elseif (strlen($data['password']) < 6) {
            $errors['password'] = 'Пароль должен содержать минимум 6 символов';
        }

        return $errors;
    }

    public static function validateLogin(array $data): array
    {
        $errors = [];

        if (empty($data['login'])) {
            $errors['login'] = 'Логин обязателен для заполнения';
        }

        if (empty($data['password'])) {
            $errors['password'] = 'Пароль обязателен для заполнения';
        }

        return $errors;
    }

    public static function validateSubscriber(array $data): array
    {
        $errors = [];

        if (empty($data['Surname'])) {
            $errors['Surname'] = 'Фамилия обязательна для заполнения';
        }

        if (empty($data['Name'])) {
            $errors['Name'] = 'Имя обязательно для заполнения';
        }

        if (empty($data['subdivision_id'])) {
            $errors['subdivision_id'] = 'Подразделение обязательно для выбора';
        }

        return $errors;
    }

    public static function validatePhone(array $data): array
    {
        $errors = [];

        if (empty($data['number_phone'])) {
            $errors['number_phone'] = 'Номер телефона обязателен для заполнения';
        } elseif (!preg_match('/^\d+$/', $data['number_phone'])) {
            $errors['number_phone'] = 'Номер телефона должен содержать только цифры';
        }

        if (empty($data['room_id'])) {
            $errors['room_id'] = 'Помещение обязательно для выбора';
        }

        return $errors;
    }

    public static function validateRoom(array $data): array
    {
        $errors = [];

        if (empty($data['name'])) {
            $errors['name'] = 'Название помещения обязательно для заполнения';
        }

        if (empty($data['Type_of_room'])) {
            $errors['Type_of_room'] = 'Тип помещения обязателен для заполнения';
        }

        if (empty($data['subdivision_id'])) {
            $errors['subdivision_id'] = 'Подразделение обязательно для выбора';
        }

        return $errors;
    }

    public static function validateSubdivision(array $data): array
    {
        $errors = [];

        if (empty($data['Name'])) {
            $errors['Name'] = 'Название подразделения обязательно для заполнения';
        }

        if (empty($data['type_of_unit'])) {
            $errors['type_of_unit'] = 'Тип подразделения обязателен для заполнения';
        }

        return $errors;
    }
}