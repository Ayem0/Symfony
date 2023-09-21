<?php

namespace App\Entity;

use App\Repository\ListsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ListsRepository::class)]
class Lists
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $name = null;

    #[ORM\ManyToOne(inversedBy: 'lists_users')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Users $id_user = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getIdUser(): ?Users
    {
        return $this->id_user;
    }

    public function setIdUser(?Users $id_user): static
    {
        $this->id_user = $id_user;

        return $this;
    }
    
}
