<?php

namespace App\Entity;

use App\Repository\AuthorsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AuthorsRepository::class)]
class Authors
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\ManyToMany(targetEntity: Books::class, mappedBy: 'authors')]
    private Collection $books_authors;

    public function __construct()
    {
        $this->books_authors = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }
    public function __toString(): string
    {
        return $this->getName().' ('.$this->getId().')';
    }
    /**
     * @return Collection<int, Books>
     */
    public function getBooksAuthors(): Collection
    {
        return $this->books_authors;
    }

    public function addBooksAuthor(Books $booksAuthor): static
    {
        if (!$this->books_authors->contains($booksAuthor)) {
            $this->books_authors->add($booksAuthor);
            $booksAuthor->addAuthor($this);
        }

        return $this;
    }

    public function removeBooksAuthor(Books $booksAuthor): static
    {
        if ($this->books_authors->removeElement($booksAuthor)) {
            $booksAuthor->removeAuthor($this);
        }

        return $this;
    }
}
