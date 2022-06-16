<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\AdditionalMaterialRepository;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *      normalizationContext={"groups"={"core:read"}},
 *      denormalizationContext={"groups"={"core:write"}},
 * )
 * @ORM\Entity(repositoryClass=AdditionalMaterialRepository::class)
 */
class AdditionalMaterial
{
    /**
     * @Groups({"core:read"})
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Groups({"core:read","core:write"})
     * @ORM\Column(type="string", length=22)
     */
    private $ref;

    /**
     * @Groups({"core:read","core:write"})
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $designation;

    /**
     * @Groups({"core:read","core:write"})
     * @ORM\Column(type="string", length=255)
     */
    private $numLot;

    /**
     * @ORM\ManyToOne(targetEntity=Molding::class, inversedBy="materialSupplementary")
     */
    private $molding;

    /**
     * @Groups({"core:read","core:write"})
     * @ORM\Column(type="string", length=255)
     */
    private $avion;

    /**
     * @Groups({"core:read","core:write"})
     * @ORM\ManyToOne(targetEntity=Type::class, inversedBy="additionalMaterials")
     */
    private $typeMaterial;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRef(): ?string
    {
        return $this->ref;
    }

    public function setRef(string $ref): self
    {
        $this->ref = $ref;

        return $this;
    }

    public function getDesignation(): ?string
    {
        return $this->designation;
    }

    public function setDesignation(?string $designation): self
    {
        $this->designation = $designation;

        return $this;
    }

    public function getNumLot(): ?string
    {
        return $this->numLot;
    }

    public function setNumLot(string $numLot): self
    {
        $this->numLot = $numLot;

        return $this;
    }

    public function getMolding(): ?Molding
    {
        return $this->molding;
    }

    public function setMolding(?Molding $molding): self
    {
        $this->molding = $molding;

        return $this;
    }

    public function getAvion(): ?string
    {
        return $this->avion;
    }

    public function setAvion(string $avion): self
    {
        $this->avion = $avion;

        return $this;
    }

    public function getTypeMaterial(): ?Type
    {
        return $this->typeMaterial;
    }

    public function setTypeMaterial(?Type $typeMaterial): self
    {
        $this->typeMaterial = $typeMaterial;

        return $this;
    }
}
