<?php

namespace Tests\Unit\Domain\ValueObject;

use PHPUnit\Framework\TestCase;
use App\Domain\ValueObject\Password;
use App\Domain\Exception\WeakPasswordException;

class PasswordTest extends TestCase
{
    public function testPasswordTooShortThrowsException(): void
    {
        $this->expectException(WeakPasswordException::class);
        new Password('S@1a');
    }

    public function testPasswordWithoutUppercaseThrowsException(): void
    {
        $this->expectException(WeakPasswordException::class);
        new Password('str0ngp@ss!');
    }

    public function testPasswordWithoutNumberThrowsException(): void
    {
        $this->expectException(WeakPasswordException::class);
        new Password('StrongP@ss!');
    }

    public function testPasswordWithoutSpecialCharacterThrowsException(): void
    {
        $this->expectException(WeakPasswordException::class);
        new Password('Str0ngPass');
    }
}
