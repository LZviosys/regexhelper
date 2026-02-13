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

    public static function maskPhoneNumber(string $string): string
    {
        $pattern = '/(\+?[0-9\(\)\-\s]{8,})/';

        return preg_replace_callback($pattern, static function ($matches) {
            return preg_replace('/\d/', '*', $matches[0]);
        }, $string);
    }

    public static function maskIBAN(string $iban): string
    {
        $cleanIban = str_replace(' ', '', $iban);
        $length = strlen($cleanIban);

        if ($length < 15) {
            return $iban;
        }

        $start = substr($cleanIban, 0, 4);
        $end = substr($cleanIban, -4);

        $middleMaskedIban = str_repeat('*', $length - 8);
        $fullMaskedIban = $start . $middleMaskedIban . $end;

        return trim(chunk_split($fullMaskedIban, 4, ' '));
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