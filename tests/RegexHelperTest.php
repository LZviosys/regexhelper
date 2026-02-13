<?php

use Lz\Regexhelper\RegexHelper;
use PHPUnit\Framework\TestCase;

class RegexHelperTest extends TestCase
{
    public function testValidateString(): void
    {
        $this->assertTrue(RegexHelper::validateString('abc123'));
        $this->assertFalse(RegexHelper::validateString('abc123!'));
    }

    public function testSanitizeString(): void
    {
        $this->assertEquals('abc123', RegexHelper::sanitizeString('abc123'));
        $this->assertEquals('abc123', RegexHelper::sanitizeString('abc123!'));
    }

    public function testSanitizeStringWithSpaces(): void
    {
        $this->assertEquals('abc123', RegexHelper::sanitizeString('abc 123'));
    }
    public function testValidateEmail(): void
    {
        $this->assertTrue(RegexHelper::validateEmail('test@gmail.com'));
        $this->assertFalse(RegexHelper::validateEmail('abc123-/$$'));
    }

    public function testValidateUrl(): void
    {
        $this->assertTrue(RegexHelper::validateUrl('https://www.google.com'));
        $this->assertFalse(RegexHelper::validateUrl('abc123-/$$'));
    }

    public function testIsValidPassword(): void
    {
        $this->assertTrue(RegexHelper::isValidPassword('Tester45!'));
        $this->assertFalse(RegexHelper::isValidPassword(''));
    }

    public function testGetPasswordWithInvalidPassword(): void
    {
        $invalidPassword = '';
        $error = RegexHelper::getPasswordsErrors($invalidPassword);

        $this->assertStringContainsString('at least 8 characters long', $error);
        $this->assertStringContainsString('at least one lowercase letter', $error);
        $this->assertStringContainsString('at least one uppercase letter', $error);
        $this->assertStringContainsString('at least one digit', $error);
        $this->assertStringContainsString('at least one special character', $error);
    }

    public function testMaskPhonenumber(): void
    {
        $phoneNumber = 'Das hier ist meine Nummer +49123456789';
        $expected = 'Das hier ist meine Nummer +***********';

        $result =  RegexHelper::maskPhoneNumber($phoneNumber);

        $this->assertEquals($expected, $result);
    }

    public function testMaskIBAN(): void
    {
        $iban = 'DE 11 1111 1111 1111 1111 11';
        $expected = 'DE11 **** **** **** **11 11';
        $result = RegexHelper::maskIBAN($iban);
        $this->assertEquals($expected, $result);
    }
}
