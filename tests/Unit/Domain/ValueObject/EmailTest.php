<?php

namespace Tests\Unit\Domain\ValueObject;

use PHPUnit\Framework\TestCase;
use App\Domain\ValueObject\Email;
use App\Domain\Exception\InvalidEmailException;

class EmailTest extends TestCase
{
    public function testValidEmail(): void
    {
        $email = new Email('john.doe@example.com');
        $this->assertSame('john.doe@example.com', $email->value());
    }

    public function testInvalidEmailThrowsException(): void
    {
        $this->expectException(InvalidEmailException::class);
        new Email('not_an_email');
    }

    public function testEmptyEmailThrowsException(): void
    {
        $this->expectException(InvalidEmailException::class);
        new Email('');
    }

    public function testEqualsMethod(): void
    {
        $email1 = new Email('test@example.com');
        $email2 = new Email('test@example.com');
        $email3 = new Email('other@example.com');

        $this->assertTrue($email1->equals($email2));
        $this->assertFalse($email1->equals($email3));
    }
}
