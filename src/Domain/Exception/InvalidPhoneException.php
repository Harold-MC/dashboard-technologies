<?php

namespace App\Domain\Exception;

use DomainException;

class InvalidPhoneException extends DomainException
{
    public function __construct(string $message = "")
    {
        if (empty($message)) {
            $message = "El formato de telefono es inválido.";
        }

        parent::__construct($message);
    }
}
