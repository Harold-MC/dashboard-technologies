<?php

namespace App\Domain\ValueObject;

use Ramsey\Uuid\Uuid;
use App\Domain\Exception\InvalidUserIdException;

class UserId
{
    private string $value;

    public function __construct(?string $value = null)
    {
        if ($value === null) {
            $this->value = Uuid::uuid4()->toString();
        } else {
            // Validar que sea un UUID correcto
            if (!Uuid::isValid($value)) {
                throw new InvalidUserIdException("El ID no es un UUID válido: $value");
            }
            $this->value = $value;
        }
    }

    public function value(): string
    {
        return $this->value;
    }

    public function equals(UserId $other): bool
    {
        return $this->value === $other->value();
    }

    public function __toString(): string
    {
        return $this->value;
    }
}
