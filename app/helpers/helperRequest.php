<?php

namespace Helpers;

use Validator\Validator;

class HelperRequest
{
    public static function validateSignup(array $data): array
    {
        $errors = [];

        if (empty($data['name'])) {
            $errors['name'] = 'Имя обязательно для заполнения';
        } elseif (strlen($data['name']) > Validator::MAX_NAME_LENGTH) {
            $errors['name'] = 'Имя не должно превышать ' . Validator::MAX_NAME_LENGTH . ' символов';
        } elseif (!preg_match(Validator::NAME, $data['name'])) {
            $errors['name'] = 'Имя может содержать только буквы, пробелы и дефисы';
        }

        if (empty($data['login'])) {
            $errors['login'] = 'Логин обязателен для заполнения';
        } elseif (strlen($data['login']) > Validator::MAX_LOGIN_LENGTH) {
            $errors['login'] = 'Логин не должен превышать ' . Validator::MAX_LOGIN_LENGTH . ' символов';
        } elseif (!preg_match(Validator::LOGIN, $data['login'])) {
            $errors['login'] = 'Логин может содержать только латинские буквы, цифры, дефисы и подчёркивания';
        }

        if (empty($data['password'])) {
            $errors['password'] = 'Пароль обязателен для заполнения';
        } elseif (strlen($data['password']) < Validator::MIN_PASSWORD_LENGTH) {
            $errors['password'] = 'Пароль должен содержать минимум ' . Validator::MIN_PASSWORD_LENGTH . ' символов';
        } elseif (!preg_match(Validator::PASSWORD_COMPLEXITY, $data['password']) ||
            !preg_match(Validator::PASSWORD_DIGITS, $data['password'])) {
            $errors['password'] = 'Пароль должен содержать хотя бы одну заглавную букву и одну цифру';
        }

        return $errors;
    }

    public static function validateLogin(array $data): array
    {
        $errors = [];

        if (empty($data['login'])) {
            $errors['login'] = 'Логин обязателен для заполнения';
        } elseif (!preg_match(Validator::LOGIN, $data['login'])) {
            $errors['login'] = 'Логин может содержать только латинские буквы, цифры, дефисы и подчёркивания';
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
        } elseif (!preg_match(Validator::SURNAME, $data['Surname'])) {
            $errors['Surname'] = 'Фамилия может содержать только буквы, пробелы и дефисы';
        }

        if (empty($data['Name'])) {
            $errors['Name'] = 'Имя обязательно для заполнения';
        } elseif (!preg_match(Validator::NAME, $data['Name'])) {
            $errors['Name'] = 'Имя может содержать только буквы, пробелы и дефисы';
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
        } elseif (!preg_match(Validator::PHONE, $data['number_phone'])) {
            $errors['number_phone'] = 'Номер телефона должен содержать от 10 до 15 цифр, может начинаться с +';
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
        } elseif (!preg_match(Validator::ROOM_NAME, $data['name'])) {
            $errors['name'] = 'Название может содержать только буквы, цифры, пробелы, дефисы и слэши';
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
        } elseif (!preg_match(Validator::SUBDIVISION_NAME, $data['Name'])) {
            $errors['Name'] = 'Название может содержать только буквы, цифры, пробелы, дефисы и слэши';
        }

        if (empty($data['type_of_unit'])) {
            $errors['type_of_unit'] = 'Тип подразделения обязателен для заполнения';
        }

        return $errors;
    }
}