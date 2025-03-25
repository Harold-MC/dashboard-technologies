<?php

namespace App\Domain\ValueObject;

use App\Domain\Exception\InvalidPhoneException;

class Phone
{
    private string $value;

    public function __construct(string $value)
    {
        if (!preg_match("/^[0-9]{3}-[0-9]{4}-[0-9]{4}$/", $value)) {
            throw new InvalidPhoneException("El formato del telefono es inválido: $value");
        }
        $this->value = $value;
    }

    public function value(): string
    {
        return $this->value;
    }

    public function __toString(): string
    {
        return $this->value;
    }

    public function equals(Phone $other): bool
    {
        return $this->value === $other->value();
    }
}
