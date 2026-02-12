<?php

namespace Lz\Regexhelper;

class RegexHelper
{
    public static function validateString(string $string): bool
    {
        return (bool) preg_match('/^[a-zA-Z0-9]+$/', $string);
    }

    public static function sanitizeString(string $string): string
    {
        return preg_replace('/[^a-zA-Z0-9]/', '', $string);
    }

    public static function validateEmail (string $email): bool
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }

    public static function validateFilename(string $filename): bool
    {
        return (bool) preg_match('/^[a-zA-Z0-9\-.]+$/', $filename);
    }
    public static function validateUrl(string $url): bool
    {
        return filter_var($url, FILTER_VALIDATE_URL) !== false;
    }

    public static function isValidPassword(string $password): bool
    {
       return self::getPasswordsErrors($password) === '';
    }

    public static function getPasswordsErrors( string $password): string {
        $message = [];

        if(strlen($password) < 8) {
            $message[] = 'at least 8 characters long';
        }
        if(!preg_match('/[a-z]/', $password)) {
            $message[] = 'at least one lowercase letter';
        }
        if(!preg_match('/[A-Z]/', $password)) {
            $message[] = 'at least one uppercase letter';
        }
        if(!preg_match('/\d/', $password)) {
            $message[] = 'at least one digit';
        }
        if(!preg_match('/\W/', $password)) {
            $message[] = 'at least one special character';
        }
        if(empty($message)) {
            return '';
        }
        return 'Password must contain:' . implode(', ', $message) . '.';
    }
}