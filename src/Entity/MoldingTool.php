<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\MoldingToolRepository;
use ApiPlatform\Core\Annotation\ApiFilter;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ApiResource(
 *      normalizationContext={"groups"={"OT:read"}},
 *      denormalizationContext={"groups"={"OT:write"}},
 * )
 * @ApiFilter(
 *      SearchFilter::class,
 *          properties={"sapToolNumber" : "exact","identification" : "exact"}
 * )
 * @ORM\Entity(repositoryClass=MoldingToolRepository::class)
 * @UniqueEntity("sapToolNumber")
 * @UniqueEntity("identification")
 */
class MoldingTool
{
    /**
     * @Groups({"OT:read"})
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Groups({"OT:read", "OT:write"})
     * @ORM\Column(type="integer", unique=true)
     */
    private $sapToolNumber;

    /**
     * @Groups({"OT:read", "OT:write"})
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $designation;

    /**
     * @Groups({"OT:read", "OT:write"})
     * @ORM\Column(type="string", length=255, nullable=true, unique=true)
     */
    private $identification;

    /**
     * @ORM\OneToMany(targetEntity=Molding::class, mappedBy="outillage")
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

    public function getsapToolNumber(): ?int
    {
        return $this->sapToolNumber;
    }

    public function setsapToolNumber(int $sapToolNumber): self
    {
        $this->sapToolNumber = $sapToolNumber;

        return $this;
    }

    public function getdesignation(): ?string
    {
        return $this->designation;
    }

    public function setdesignation(?string $designation): self
    {
        $this->designation = $designation;

        return $this;
    }

    public function getidentification(): ?string
    {
        return $this->identification;
    }

    public function setidentification(?string $identification): self
    {
        $this->identification = $identification;

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
            $molding->setOutillage($this);
        }

        return $this;
    }

    public function removeMolding(Molding $molding): self
    {
        if ($this->moldings->removeElement($molding)) {
            // set the owning side to null (unless already changed)
            if ($molding->getOutillage() === $this) {
                $molding->setOutillage(null);
            }
        }

        return $this;
    }
}
