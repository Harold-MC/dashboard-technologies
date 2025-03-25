<?php

namespace App\Domain\Entity;

use App\Domain\ValueObject\UserId;
use App\Domain\ValueObject\Name;
use App\Domain\ValueObject\Email;
use App\Domain\ValueObject\Password;
use App\Domain\ValueObject\Phone;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'users')]
class User
{
    #[ORM\Id]
    #[ORM\Column(type: 'string', length: 36, unique: true)]
    private string $id;

    #[ORM\Column(type: 'string', length: 100)]
    private string $name;

    #[ORM\Column(type: 'string', length: 12)]
    private string $phone;

    #[ORM\Column(type: 'string', length: 120, unique: true)]
    private string $email;

    #[ORM\Column(type: 'string', length: 255)]
    private string $password;

    #[ORM\Column(type: 'datetime_immutable')]
    private \DateTimeImmutable $created_at;

    public function __construct(
        UserId $id,
        Name $name,
        Email $email,
        Phone $phone,
        Password $password
    ) {
        $this->id = $id->value();
        $this->phone = $phone->value();
        $this->name = $name->value();
        $this->email = $email->value();
        $this->password = $password->hashed();
        $this->created_at = new \DateTimeImmutable();
    }

    public function id(): UserId
    {
        return new UserId($this->id);
    }

    public function name(): Name
    {
        return new Name($this->name);
    }

    public function email(): Email
    {
        return new Email($this->email);
    }

    public function phone(): Phone
    {
        return new Phone($this->phone);
    }

    public function password(): string
    {
        return $this->password;
    }

    public function createdAt(): \DateTimeImmutable
    {
        return $this->created_at;
    }
}
