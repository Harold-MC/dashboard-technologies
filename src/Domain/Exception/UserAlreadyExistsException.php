<?php

namespace App\Domain\Exception;

use DomainException;

class UserAlreadyExistsException extends DomainException
{
    public function __construct(string $message = "")
    {
        if (empty($message)) {
            $message = "Ya existe un usuario registrado con ese email.";
        }

        parent::__construct($message);
    }
}
