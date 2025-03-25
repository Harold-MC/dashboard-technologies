<?php

namespace Tests\Unit\Domain\ValueObject;

use PHPUnit\Framework\TestCase;
use App\Domain\ValueObject\Phone;

class PhoneTest extends TestCase
{
    public function testValidPhoneNumber(): void
    {
        $email = new Phone('000-0000-00t0');
        $this->assertSame('000-0000-00t0', $email->value());
    }

}
