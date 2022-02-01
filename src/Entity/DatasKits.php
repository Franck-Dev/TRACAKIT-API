<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\DatasKitsRepository;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=DatasKitsRepository::class)
 * @UniqueEntity("idMM")
 */
class DatasKits
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=10, unique=true)
     */
    private $idMM;

    /**
     * @ORM\Column(type="integer")
     */
    private $ReferenceSAP;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $DesignationSAP;

    /**
     * @ORM\Column(type="float")
     */
    private $TackLife;

    /**
     * @ORM\Column(type="float")
     */
    private $TimeOut;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $LotSAP;

    /**
     * @ORM\Column(type="datetime")
     */
    private $PeremptionMoins18;

    /**
     * @ORM\Column(type="datetime")
     */
    private $ADrapAv;

    /**
     * @ORM\Column(type="datetime")
     */
    private $ACuirAv;

    /**
     * @ORM\Column(type="datetime")
     */
    private $Decongel;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    private $updateAt;

    /**
     * @ORM\Column(type="boolean")
     */
    private $status;

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
}
