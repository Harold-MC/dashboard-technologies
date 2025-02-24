<?php

namespace App\Domain\ValueObject;

use App\Domain\Exception\WeakPasswordException;

class Password
{
    private string $hashed;

    private const MIN_LENGTH = 8;

    public function __construct(string $plainPassword)
    {
        $this->ensureIsValid($plainPassword);
        $this->hashed = password_hash($plainPassword, PASSWORD_BCRYPT);
    }

    private function ensureIsValid(string $plainPassword): void
    {
        if (mb_strlen($plainPassword) < self::MIN_LENGTH) {
            throw new WeakPasswordException("La contraseña debe tener al menos ".self::MIN_LENGTH." caracteres.");
        }

        // Al menos una letra mayúscula
        if (!preg_match('/[A-Z]/', $plainPassword)) {
            throw new WeakPasswordException("La contraseña debe contener al menos una letra mayúscula.");
        }

        // Al menos un dígito
        if (!preg_match('/\d/', $plainPassword)) {
            throw new WeakPasswordException("La contraseña debe contener al menos un dígito.");
        }

        // Al menos un carácter especial (no alfanumérico)
        if (!preg_match('/[^a-zA-Z0-9]/', $plainPassword)) {
            throw new WeakPasswordException("La contraseña debe contener al menos un carácter especial.");
        }
    }

    public function hashed(): string
    {
        return $this->hashed;
    }

    public function verify(string $plainPassword): bool
    {
        return password_verify($plainPassword, $this->hashed);
    }

    public function equals(Password $other): bool
    {
        return $this->hashed === $other->hashed();
    }
}
