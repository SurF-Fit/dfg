<?php

namespace Controller;

use Helpers\HelperRequest;
use Helpers\HelperResponse;
use Model\Subdivision;
use Model\Subscriber;
use Src\Request;
use Src\View;

class createSubscribers
{
    public function createSubscribers(Request $request): string
    {
        if($_SESSION['role'] == 2) {
            if ($request->method === 'POST') {
                $errors = HelperRequest::validateSubscriber($request->all());

                if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
                    $maxFileSize = 2 * 1024 * 1024; // 2MB

                    if (!in_array($_FILES['image']['type'], $allowedTypes)) {
                        $errors['image'] = 'Допустимы только изображения в формате JPEG, PNG или GIF';
                    } elseif ($_FILES['image']['size'] > $maxFileSize) {
                        $errors['image'] = 'Размер файла не должен превышать 2MB';
                    }
                }

                if (empty($errors)) {
                    $imagePath = null;

                    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                        $uploadDir = $_SERVER['DOCUMENT_ROOT'] . '/public/uploads/subscribers/';
                        if (!file_exists($uploadDir)) {
                            mkdir($uploadDir, 0777, true);
                        }

                        $extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
                        $filename = uniqid() . '.' . $extension;
                        $relativePath = 'uploads/subscribers/' . $filename;
                        $absolutePath = $uploadDir . $filename;

                        if (!move_uploaded_file($_FILES['image']['tmp_name'], $absolutePath)) {
                            HelperResponse::redirectWithMessage('/createSubscribers', 'Ошибка при загрузке изображения');
                        }

                        $imagePath = $relativePath;
                    }

                    Subscriber::create([
                        'Surname' => $request->Surname,
                        'Name' => $request->Name,
                        'SurnameSecond' => $request->SurnameSecond,
                        'Date_of_birth' => $request->Date_of_birth,
                        'image_path' => $imagePath,
                    ]);

                    HelperResponse::redirectWithMessage('/hello', 'Абонент успешно создан');
                }

                return new View('site.createSubscribers', [
                    'message' => HelperResponse::validationErrors($errors),
                    'request' => $request,
                ]);
            }

            return new View('site.createSubscribers');
        }

        return new View('site.hello');
    }
}