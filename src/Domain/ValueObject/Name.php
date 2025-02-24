<?php

namespace App\Domain\ValueObject;

use App\Domain\Exception\InvalidNameException;

class Name
{
    private const MIN_LENGTH = 3;
    private const MAX_LENGTH = 50;

    private string $value;

    public function __construct(string $value)
    {
        $clean = trim($value);
        $length = mb_strlen($clean);

        // Validación de longitud
        if ($length < self::MIN_LENGTH || $length > self::MAX_LENGTH) {
            throw new InvalidNameException(
                "El nombre debe tener entre ".self::MIN_LENGTH." y ".self::MAX_LENGTH." caracteres."
            );
        }

        // Validación de caracteres permitidos (ejemplo: letras, espacios, apóstrofes, puntos, guiones, etc.)
        if (!preg_match("/^[A-Za-zÁ-Úá-úÑñ\s'.-]+$/u", $clean)) {
            throw new InvalidNameException("El nombre contiene caracteres no permitidos.");
        }

        $this->value = $clean;
    }

    public function value(): string
    {
        return $this->value;
    }

    public function __toString(): string
    {
        return $this->value;
    }

    public function equals(Name $other): bool
    {
        return $this->value === $other->value();
    }
}
