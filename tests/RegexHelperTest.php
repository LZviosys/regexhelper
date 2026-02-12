<?php

use Lz\Regexhelper\RegexHelper;
use PHPUnit\Framework\TestCase;

class RegexHelperTest extends TestCase
{
    public function testValidateString()
    {
        $this->assertTrue(RegexHelper::validateString('abc123'));
        $this->assertFalse(RegexHelper::validateString('abc123!'));
    }

    public function testSanitizeString()
    {
        $this->assertEquals('abc123', RegexHelper::sanitizeString('abc123'));
        $this->assertEquals('abc123', RegexHelper::sanitizeString('abc123!'));
    }

    public function testSanitizeStringWithSpaces()
    {
        $this->assertEquals('abc123', RegexHelper::sanitizeString('abc 123'));
    }
    public function testValidateEmail()
    {
        $this->assertTrue(RegexHelper::validateEmail('test@gmail.com'));
        $this->assertFalse(RegexHelper::validateEmail('abc123-/$$'));
    }

    public function testValidateUrl()
    {
        $this->assertTrue(RegexHelper::validateUrl('https://www.google.com'));
        $this->assertFalse(RegexHelper::validateUrl('abc123-/$$'));
    }

    public function testIsValidPassword()
    {
        $this->assertTrue(RegexHelper::isValidPassword('Tester45!'));
        $this->assertFalse(RegexHelper::isValidPassword(''));
    }

    public function testGetPasswordWithInvalidPassword()
    {
        $invalidPassword = '';
        $error = RegexHelper::getPasswordsErrors($invalidPassword);

        $this->assertStringContainsString('at least 8 characters long', $error);
        $this->assertStringContainsString('at least one lowercase letter', $error);
        $this->assertStringContainsString('at least one uppercase letter', $error);
        $this->assertStringContainsString('at least one digit', $error);
        $this->assertStringContainsString('at least one special character', $error);
    }
}
