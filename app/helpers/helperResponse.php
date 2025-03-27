<?php

namespace Helpers;

class HelperResponse
{
    public static function validationErrors(array $errors): string
    {
        $html = '<div class="alert alert-danger"><ul>';
        foreach ($errors as $error) {
            $html .= "<li>{$error}</li>";
        }
        $html .= '</ul></div>';
        return $html;
    }

    public static function successMessage(string $message): string
    {
        return '<div class="alert alert-success">' . $message . '</div>';
    }

    public static function errorMessage(string $message): string
    {
        return '<div class="alert alert-danger">' . $message . '</div>';
    }

    public static function redirectWithMessage(string $url, string $message, string $type = 'success'): void
    {
        $_SESSION['flash_message'] = $message;
        $_SESSION['flash_type'] = $type;
        header('Location: ' . $url);
        exit();
    }

    public static function displayFlashMessage(): ?string
    {
        if (isset($_SESSION['flash_message'])) {
            $message = $_SESSION['flash_message'];
            $type = $_SESSION['flash_type'] ?? 'success';
            unset($_SESSION['flash_message'], $_SESSION['flash_type']);

            return '<div' . $type . '">' . $message . '</div>';
        }
        return null;
    }
}