<?php

namespace App\Entity;

use App\Repository\UsersRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UsersRepository::class)]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
class Users implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $email = null;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $created_at = null;

    #[ORM\OneToMany(mappedBy: 'id_users', targetEntity: BooksNotes::class)]
    private Collection $users_BooksNotes;

    #[ORM\OneToMany(mappedBy: 'id_user', targetEntity: Lists::class)]
    private Collection $lists_users;

    #[ORM\Column(length: 255)]
    private ?string $username = null;

    public function __construct()
    {
        $this->users_BooksNotes = new ArrayCollection();
        $this->lists_users = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): static
    {
        $this->created_at = $created_at;

        return $this;
    }

    /**
     * @return Collection<int, BooksNotes>
     */
    public function getUsersBooksNotes(): Collection
    {
        return $this->users_BooksNotes;
    }

    public function addUsersBooksNote(BooksNotes $usersBooksNote): static
    {
        if (!$this->users_BooksNotes->contains($usersBooksNote)) {
            $this->users_BooksNotes->add($usersBooksNote);
            $usersBooksNote->setIdUsers($this);
        }

        return $this;
    }

    public function removeUsersBooksNote(BooksNotes $usersBooksNote): static
    {
        if ($this->users_BooksNotes->removeElement($usersBooksNote)) {
            // set the owning side to null (unless already changed)
            if ($usersBooksNote->getIdUsers() === $this) {
                $usersBooksNote->setIdUsers(null);
            }
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->getEmail().' ('.$this->getId().')';
    }
    /**
     * @return Collection<int, Lists>
     */
    public function getListsUsers(): Collection
    {
        return $this->lists_users;
    }

    public function addListsUser(Lists $listsUser): static
    {
        if (!$this->lists_users->contains($listsUser)) {
            $this->lists_users->add($listsUser);
            $listsUser->setIdUser($this);
        }

        return $this;
    }

    public function removeListsUser(Lists $listsUser): static
    {
        if ($this->lists_users->removeElement($listsUser)) {
            // set the owning side to null (unless already changed)
            if ($listsUser->getIdUser() === $this) {
                $listsUser->setIdUser(null);
            }
        }

        return $this;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): static
    {
        $this->username = $username;

        return $this;
    }
}
