<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\MoldingRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=MoldingRepository::class)
 */
class Molding
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToMany(targetEntity=dataskits::class, inversedBy="moldings")
     */
    private $Kits;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $MoldingDay;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $ACuireAv;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    private $ADraperAv;

    /**
     * @ORM\ManyToOne(targetEntity=DatasKits::class, inversedBy="moldings")
     * @ORM\JoinColumn(nullable=false)
     */
    private $MatPolym;

    /**
     * @ORM\ManyToOne(targetEntity=DatasKits::class, inversedBy="moldings")
     * @ORM\JoinColumn(nullable=false)
     */
    private $MatDrap;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $CreatedAt;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    private $UpdatedAt;

    public function __construct()
    {
        $this->Kits = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|dataskits[]
     */
    public function getKits(): Collection
    {
        return $this->Kits;
    }

    public function addKit(dataskits $kit): self
    {
        if (!$this->Kits->contains($kit)) {
            $this->Kits[] = $kit;
        }

        return $this;
    }

    public function removeKit(dataskits $kit): self
    {
        $this->Kits->removeElement($kit);

        return $this;
    }

    public function getMoldingDay(): ?\DateTimeImmutable
    {
        return $this->MoldingDay;
    }

    public function setMoldingDay(\DateTimeImmutable $MoldingDay): self
    {
        $this->MoldingDay = $MoldingDay;

        return $this;
    }

    public function getACuireAv(): ?\DateTimeImmutable
    {
        return $this->ACuireAv;
    }

    public function setACuireAv(\DateTimeImmutable $ACuireAv): self
    {
        $this->ACuireAv = $ACuireAv;

        return $this;
    }

    public function getADraperAv(): ?\DateTimeImmutable
    {
        return $this->ADraperAv;
    }

    public function setADraperAv(?\DateTimeImmutable $ADraperAv): self
    {
        $this->ADraperAv = $ADraperAv;

        return $this;
    }

    public function getMatPolym(): ?DatasKits
    {
        return $this->MatPolym;
    }

    public function setMatPolym(?DatasKits $MatPolym): self
    {
        $this->MatPolym = $MatPolym;

        return $this;
    }

    public function getMatDrap(): ?DatasKits
    {
        return $this->MatDrap;
    }

    public function setMatDrap(?DatasKits $MatDrap): self
    {
        $this->MatDrap = $MatDrap;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->CreatedAt;
    }

    public function setCreatedAt(\DateTimeImmutable $CreatedAt): self
    {
        $this->CreatedAt = $CreatedAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->UpdatedAt;
    }

    public function setUpdatedAt(?\DateTimeImmutable $UpdatedAt): self
    {
        $this->UpdatedAt = $UpdatedAt;

        return $this;
    }
}
