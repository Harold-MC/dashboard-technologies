<?php

namespace Tests\Unit\Domain\ValueObject;

use PHPUnit\Framework\TestCase;
use App\Domain\ValueObject\Name;
use App\Domain\Exception\InvalidNameException;

class NameTest extends TestCase
{
    public function testValidName(): void
    {
        $name = new Name('John Doe');
        $this->assertEquals('John Doe', $name->value());
    }

    public function testNameTooShortThrowsException(): void
    {
        $this->expectException(InvalidNameException::class);
        new Name('Jo');
    }

    public function testNameWithInvalidCharactersThrowsException(): void
    {
        $this->expectException(InvalidNameException::class);
        new Name('John123');
    }
}
