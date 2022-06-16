<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\TypeRepository;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ApiResource(
 * *      collectionOperations={
 *              "get",
 *              "post"={"security"="is_granted('ROLE_USER')"}
 *      },
 *      itemOperations={"get","put"={"security"="is_granted('ROLE_CE_MOULAGE')"},
 *                      "patch"={"security"="is_granted('ROLE_CE_MOULAGE')"},
 *                      "delete"={"security"="is_granted('ROLE_ADMIN')"}
 *      },
 *      normalizationContext={"groups"={"type:read"}},
 *      denormalizationContext={"groups"={"type:write"}},
 *      order={"designation" ="ASC"}
 * )
 * @ORM\Entity(repositoryClass=TypeRepository::class)
 * @UniqueEntity(fields={"designation"})
 */
class Type
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $designation;

    /**
     * @ORM\OneToMany(targetEntity=AdditionalMaterial::class, mappedBy="typeMaterial")
     */
    private $additionalMaterials;

    public function __construct()
    {
        $this->additionalMaterials = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDesignation(): ?string
    {
        return $this->designation;
    }

    public function setDesignation(string $designation): self
    {
        $this->designation = $designation;

        return $this;
    }

    /**
     * @return Collection|AdditionalMaterial[]
     */
    public function getAdditionalMaterials(): Collection
    {
        return $this->additionalMaterials;
    }

    public function addAdditionalMaterial(AdditionalMaterial $additionalMaterial): self
    {
        if (!$this->additionalMaterials->contains($additionalMaterial)) {
            $this->additionalMaterials[] = $additionalMaterial;
            $additionalMaterial->setTypeMaterial($this);
        }

        return $this;
    }

    public function removeAdditionalMaterial(AdditionalMaterial $additionalMaterial): self
    {
        if ($this->additionalMaterials->removeElement($additionalMaterial)) {
            // set the owning side to null (unless already changed)
            if ($additionalMaterial->getTypeMaterial() === $this) {
                $additionalMaterial->setTypeMaterial(null);
            }
        }

        return $this;
    }
}
