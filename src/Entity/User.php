<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class User
{
    #[ORM\Id] #[ORM\Column(type: "integer")] #[ORM\GeneratedValue()]
    public int $id;

    #[ORM\Column(length: 50)]
    public string $name;

    #[ORM\Column(unique: true)]
    public string $email;

    #[ORM\Column()]
    public string $password;

    #[ORM\ManyToOne(targetEntity: Role::class)]
    #[ORM\JoinColumn(name: 'role_id', referencedColumnName: 'id')]
    public Role $role;

    // php vendor/bin/doctrine orm:schema-tool:update --force

    public function __construct(string $name, string $email, string $password)
    {
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
    }
}