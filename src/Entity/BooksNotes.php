<?php

namespace App\Entity;

use App\Repository\BooksNotesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BooksNotesRepository::class)]
class BooksNotes
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    private ?float $note = null;

    #[ORM\Column(length: 255)]
    private ?string $date = null;

    #[ORM\ManyToOne(inversedBy: 'users_BooksNotes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Users $id_users = null;

    #[ORM\ManyToOne(inversedBy: 'booksnotes_books')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Books $id_books = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNote(): ?float
    {
        return $this->note;
    }

    public function setNote(?float $note): static
    {
        $this->note = $note;

        return $this;
    }

    public function getDate(): ?string
    {
        return $this->date;
    }

    public function setDate(string $date): static
    {
        $this->date = $date;

        return $this;
    }

    public function getIdUsers(): ?Users
    {
        return $this->id_users;
    }

    public function setIdUsers(?Users $id_users): static
    {
        $this->id_users = $id_users;

        return $this;
    }

    public function getIdBooks(): ?Books
    {
        return $this->id_books;
    }

    public function setIdBooks(?Books $id_books): static
    {
        $this->id_books = $id_books;

        return $this;
    }
}
