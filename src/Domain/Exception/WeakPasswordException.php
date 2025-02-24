<?php

namespace App\Domain\Exception;

use DomainException;

class WeakPasswordException extends DomainException
{
    public function __construct(string $message = "")
    {
        if (empty($message)) {
            $message = "La contraseña no cumple con los requisitos de seguridad.";
        }

        parent::__construct($message);
    }
}
