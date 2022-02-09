<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\DatasKitsRepository;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ApiResource(
 *  collectionOperations={"get","post"},
 *  itemOperations={"get","put","delete"},
 *  normalizationContext={"groups"={"kit:read"}},
 *  denormalizationContext={"groups"={"kit:write"}}
 * )
 * @ApiFilter(
 *  SearchFilter::class,
 *      properties={"idMM" : "exact","status" : "exact"}
 * )
 * @ORM\Entity(repositoryClass=DatasKitsRepository::class)
 * @UniqueEntity("idMM")
 */
class DatasKits
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups("kit:read")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=10, unique=true)
     * @Groups({"kit:read","kit:write"})
     */
    private $idMM;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"kit:read","kit:write"})
     */
    private $ReferenceSAP;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"kit:read","kit:write"})
     */
    private $DesignationSAP;

    /**
     * @ORM\Column(type="float")
     * @Groups({"kit:read","kit:write"})
     */
    private $TackLife;

    /**
     * @ORM\Column(type="float")
     * @Groups({"kit:read","kit:write"})
     */
    private $TimeOut;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Groups({"kit:read","kit:write"})
     */
    private $LotSAP;

    /**
     * @ORM\Column(type="datetime")
     * @Groups({"kit:read","kit:write"})
     */
    private $PeremptionMoins18;

    /**
     * @ORM\Column(type="datetime")
     * @Groups({"kit:read","kit:write"})
     */
    private $ADrapAv;

    /**
     * @ORM\Column(type="datetime")
     * @Groups({"kit:read","kit:write"})
     */
    private $ACuirAv;

    /**
     * @ORM\Column(type="datetime")
     * @Groups({"kit:read","kit:write"})
     */
    private $Decongel;

    /**
     * @ORM\Column(type="datetime_immutable")
     * @Groups("kit:read",)
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     * @Groups("kit:read")
     */
    private $updateAt;

    /**
     * @ORM\Column(type="boolean")
     * @Groups({"kit:read","kit:write"})
     */
    private $status;

    /**
     * @ORM\ManyToMany(targetEntity=Molding::class, mappedBy="Kits")
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

    public function getIdMM(): ?string
    {
        return $this->idMM;
    }

    public function setIdMM(string $idMM): self
    {
        $this->idMM = $idMM;

        return $this;
    }

    public function getReferenceSAP(): ?int
    {
        return $this->ReferenceSAP;
    }

    public function setReferenceSAP(int $ReferenceSAP): self
    {
        $this->ReferenceSAP = $ReferenceSAP;

        return $this;
    }

    public function getDesignationSAP(): ?string
    {
        return $this->DesignationSAP;
    }

    public function setDesignationSAP(?string $DesignationSAP): self
    {
        $this->DesignationSAP = $DesignationSAP;

        return $this;
    }

    public function getTackLife(): ?float
    {
        return $this->TackLife;
    }

    public function setTackLife(float $TackLife): self
    {
        $this->TackLife = $TackLife;

        return $this;
    }

    public function getTimeOut(): ?float
    {
        return $this->TimeOut;
    }

    public function setTimeOut(float $TimeOut): self
    {
        $this->TimeOut = $TimeOut;

        return $this;
    }

    public function getLotSAP(): ?int
    {
        return $this->LotSAP;
    }

    public function setLotSAP(?int $LotSAP): self
    {
        $this->LotSAP = $LotSAP;

        return $this;
    }

    public function getPeremptionMoins18(): ?\DateTimeInterface
    {
        return $this->PeremptionMoins18;
    }

    public function setPeremptionMoins18(\DateTimeInterface $PeremptionMoins18): self
    {
        $this->PeremptionMoins18 = $PeremptionMoins18;

        return $this;
    }

    public function getADrapAv(): ?\DateTimeInterface
    {
        return $this->ADrapAv;
    }

    public function setADrapAv(\DateTimeInterface $ADrapAv): self
    {
        $this->ADrapAv = $ADrapAv;

        return $this;
    }

    public function getACuirAv(): ?\DateTimeInterface
    {
        return $this->ACuirAv;
    }

    public function setACuirAv(\DateTimeInterface $ACuirAv): self
    {
        $this->ACuirAv = $ACuirAv;

        return $this;
    }

    public function getDecongel(): ?\DateTimeInterface
    {
        return $this->Decongel;
    }

    public function setDecongel(\DateTimeInterface $Decongel): self
    {
        $this->Decongel = $Decongel;

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

    public function getUpdateAt(): ?\DateTimeImmutable
    {
        return $this->updateAt;
    }

    public function setUpdateAt(?\DateTimeImmutable $updateAt): self
    {
        $this->updateAt = $updateAt;

        return $this;
    }

    public function getStatus(): ?bool
    {
        return $this->status;
    }

    public function setStatus(bool $status): self
    {
        $this->status = $status;

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
            $molding->addKit($this);
        }

        return $this;
    }

    public function removeMolding(Molding $molding): self
    {
        if ($this->moldings->removeElement($molding)) {
            $molding->removeKit($this);
        }

        return $this;
    }
}
