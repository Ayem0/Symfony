<?php

namespace App\Entity;

use App\Repository\CategoriesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategoriesRepository::class)]
class Categories
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: 'mainCategory', targetEntity: Books::class)]
    private Collection $mainCategory_books;

    #[ORM\ManyToMany(targetEntity: Books::class, mappedBy: 'subCategories')]
    private Collection $subCategories_books;

    public function __construct()
    {
        $this->mainCategory_books = new ArrayCollection();
        $this->subCategories_books = new ArrayCollection();
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

    /**
     * @return Collection<int, Books>
     */
    public function getMainCategoryBooks(): Collection
    {
        return $this->mainCategory_books;
    }

    public function addMainCategoryBook(Books $mainCategoryBook): static
    {
        if (!$this->mainCategory_books->contains($mainCategoryBook)) {
            $this->mainCategory_books->add($mainCategoryBook);
            $mainCategoryBook->setMainCategory($this);
        }

        return $this;
    }

    public function removeMainCategoryBook(Books $mainCategoryBook): static
    {
        if ($this->mainCategory_books->removeElement($mainCategoryBook)) {
            // set the owning side to null (unless already changed)
            if ($mainCategoryBook->getMainCategory() === $this) {
                $mainCategoryBook->setMainCategory(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Books>
     */
    public function getSubCategoriesBooks(): Collection
    {
        return $this->subCategories_books;
    }

    public function addSubCategoriesBook(Books $subCategoriesBook): static
    {
        if (!$this->subCategories_books->contains($subCategoriesBook)) {
            $this->subCategories_books->add($subCategoriesBook);
            $subCategoriesBook->addSubCategory($this);
        }

        return $this;
    }

    public function removeSubCategoriesBook(Books $subCategoriesBook): static
    {
        if ($this->subCategories_books->removeElement($subCategoriesBook)) {
            $subCategoriesBook->removeSubCategory($this);
        }

        return $this;
    }
}
