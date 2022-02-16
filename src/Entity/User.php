<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use App\Repository\UserRepository;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use App\Controller\SecurityController;

/**
 * * @ApiResource(
 *      attributes={"pagination_enabled"=false},
 *      collectionOperations={
*              "get","post",
*              "login"={
*                  "method"="POST",
*                  "path"="/login",
*                  "controller"="SecurityController::class",
*                  "denormalization_context"={"groups"={"user:login"}}
*              }
 *       },
 *     normalizationContext={"groups"={"user:read"}},
 *     denormalizationContext={"groups"={"user:write"}},
 * )
 * @UniqueEntity(fields={"username"})
 * @UniqueEntity(fields={"matricule"})
 * @UniqueEntity(fields={"mail"})
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    /**
     * @Groups({"user:read"})
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Groups({"user:read"})
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $username;

    /**
     * @Groups({"user:write"})
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @Groups({"user:write","user:login"})
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @Assert\Email
     * @Groups({"user:read"})
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $mail;

    /**
     * @Assert\NotBlank()
     * @Groups({"user:read", "user:write","user:login"})
     * @ORM\Column(type="integer", unique=true)
     */
    private $matricule;

    /**
     * @Assert\NotBlank()
     * @Groups({"user:write"})
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @Assert\NotBlank()
     * @Groups({"user:write"})
     * @ORM\Column(type="string", length=255)
     */
    private $prenom;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    private $updatedAt;

    /**
     * @Groups({"user:read"})
     * @ORM\Column(type="boolean")
     */
    private $isActive;

    /**
     * @Groups({"user:read"})
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    private $lastCon;

    /**
     * @ORM\OneToMany(targetEntity=Molding::class, mappedBy="createdBy")
     */
    private $moldings;

    public function __construct()
    {
        $this->moldings = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @deprecated since Symfony 5.3, use getUserIdentifier instead
     */
    public function getUsername(): string
    {
        return (string) $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->matricule;
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

    public function setRoles(array $roles): self
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

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(?string $mail): self
    {
        $this->mail = $mail;

        return $this;
    }

    public function getMatricule(): ?int
    {
        return $this->matricule;
    }

    public function setMatricule(int $matricule): self
    {
        $this->matricule = $matricule;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeImmutable $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getIsActive(): ?bool
    {
        return $this->isActive;
    }

    public function setIsActive(bool $isActive): self
    {
        $this->isActive = $isActive;

        return $this;
    }

    public function getLastCon(): ?\DateTimeImmutable
    {
        return $this->lastCon;
    }

    public function setLastCon(?\DateTimeImmutable $lastCon): self
    {
        $this->lastCon = $lastCon;

        return $this;
    }

    /**
     * @return Collection|Molding[]
     */
    public function getMoldings(): Collection
    {
        return $this->moldings;
    }

    public function addMolding(Molding $molding): self
    {
        if (!$this->moldings->contains($molding)) {
            $this->moldings[] = $molding;
            $molding->setCreatedBy($this);
        }

        return $this;
    }

    public function removeMolding(Molding $molding): self
    {
        if ($this->moldings->removeElement($molding)) {
            // set the owning side to null (unless already changed)
            if ($molding->getCreatedBy() === $this) {
                $molding->setCreatedBy(null);
            }
        }

        return $this;
    }
}
