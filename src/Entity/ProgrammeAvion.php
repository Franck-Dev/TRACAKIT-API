<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ProgrammeAvionRepository;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ApiResource(
 *  collectionOperations={"get","post"},
 *  itemOperations={"get"},
 *  normalizationContext={"groups"={"progAv:read"}},
 *  denormalizationContext={"groups"={"progAv:write"}},
 * )
 * @ORM\Entity(repositoryClass=ProgrammeAvionRepository::class)
 */
class ProgrammeAvion
{
    /**
     * @Groups({"progAv:read"})
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Groups({"progAv:read","progAv:write"})
     * @Assert\NotBlank()
     * @ORM\Column(type="string", length=255)
     */
    private $Designation;

    /**
     * @Groups({"progAv:read","progAv:write"})
     * @ORM\Column(type="string", length=6, nullable=true)
     */
    private $Code;

    /**
     * @Groups({"progAv:read","progAv:write"})
     * @Assert\NotBlank()
     * @ORM\Column(type="string", length=255)
     */
    private $client;

    /**
     * @ORM\ManyToMany(targetEntity=User::class, mappedBy="programmeAvion")
     */
    private $users;

    public function __construct()
    {
        $this->users = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDesignation(): ?string
    {
        return $this->Designation;
    }

    public function setDesignation(string $Designation): self
    {
        $this->Designation = $Designation;

        return $this;
    }

    public function getCode(): ?string
    {
        return $this->Code;
    }

    public function setCode(?string $Code): self
    {
        $this->Code = $Code;

        return $this;
    }

    public function getClient(): ?string
    {
        return $this->client;
    }

    public function setClient(string $client): self
    {
        $this->client = $client;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
            $user->addProgrammeAvion($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->removeElement($user)) {
            $user->removeProgrammeAvion($this);
        }

        return $this;
    } 
}
