<?php

namespace App\Entity;

use App\Repository\BooksRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BooksRepository::class)]
class Books
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\ManyToOne(inversedBy: 'mainCategory_books')]
    private ?Categories $mainCategory = null;

    #[ORM\ManyToMany(targetEntity: Categories::class, inversedBy: 'subCategories_books')]
    private Collection $subCategories;

    #[ORM\Column(nullable: true)]
    private ?float $note = null;

    #[ORM\Column(length: 255)]
    private ?string $isbn = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $image = null;

    #[ORM\Column(length: 255)]
    private ?string $published_date = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $description = null;

    #[ORM\OneToMany(mappedBy: 'id_books', targetEntity: BooksNotes::class)]
    private Collection $booksnotes_books;

    #[ORM\ManyToMany(targetEntity: Authors::class, inversedBy: 'books_authors')]
    private Collection $authors;

    public function __construct()
    {
        $this->subCategories = new ArrayCollection();
        $this->booksnotes_books = new ArrayCollection();
        $this->authors = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getMainCategory(): ?Categories
    {
        return $this->mainCategory;
    }

    public function setMainCategory(?Categories $mainCategory): static
    {
        $this->mainCategory = $mainCategory;

        return $this;
    }

    /**
     * @return Collection<int, Categories>
     */
    public function getSubCategories(): Collection
    {
        return $this->subCategories;
    }

    public function addSubCategory(Categories $subCategory): static
    {
        if (!$this->subCategories->contains($subCategory)) {
            $this->subCategories->add($subCategory);
        }

        return $this;
    }

    public function removeSubCategory(Categories $subCategory): static
    {
        $this->subCategories->removeElement($subCategory);

        return $this;
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

    public function getIsbn(): ?string
    {
        return $this->isbn;
    }

    public function setIsbn(string $isbn): static
    {
        $this->isbn = $isbn;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): static
    {
        $this->image = $image;

        return $this;
    }

    public function getPublishedDate(): ?string
    {
        return $this->published_date;
    }

    public function setPublishedDate(string $published_date): static
    {
        $this->published_date = $published_date;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection<int, BooksNotes>
     */
    public function getBooksnotesBooks(): Collection
    {
        return $this->booksnotes_books;
    }

    public function addBooksnotesBook(BooksNotes $booksnotesBook): static
    {
        if (!$this->booksnotes_books->contains($booksnotesBook)) {
            $this->booksnotes_books->add($booksnotesBook);
            $booksnotesBook->setIdBooks($this);
        }

        return $this;
    }

    public function removeBooksnotesBook(BooksNotes $booksnotesBook): static
    {
        if ($this->booksnotes_books->removeElement($booksnotesBook)) {
            // set the owning side to null (unless already changed)
            if ($booksnotesBook->getIdBooks() === $this) {
                $booksnotesBook->setIdBooks(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Authors>
     */
    public function getAuthors(): Collection
    {
        return $this->authors;
    }

    public function addAuthor(Authors $author): static
    {
        if (!$this->authors->contains($author)) {
            $this->authors->add($author);
        }

        return $this;
    }

    public function removeAuthor(Authors $author): static
    {
        $this->authors->removeElement($author);

        return $this;
    }
}
