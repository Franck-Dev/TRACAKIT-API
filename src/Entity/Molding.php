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
    private $kits;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $moldingDay;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $aCuireAv;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    private $aDraperAv;

    /**
     * @ORM\ManyToOne(targetEntity=DatasKits::class, inversedBy="moldings")
     * @ORM\JoinColumn(nullable=false)
     */
    private $matPolym;

    /**
     * @ORM\ManyToOne(targetEntity=DatasKits::class, inversedBy="moldings")
     * @ORM\JoinColumn(nullable=false)
     */
    private $matDrap;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    private $updatedAt;

    public function __construct()
    {
        $this->kits = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|dataskits[]
     */
    public function getkits(): Collection
    {
        return $this->kits;
    }

    public function addKit(dataskits $kit): self
    {
        if (!$this->kits->contains($kit)) {
            $this->kits[] = $kit;
        }

        return $this;
    }

    public function removeKit(dataskits $kit): self
    {
        $this->kits->removeElement($kit);

        return $this;
    }

    public function getmoldingDay(): ?\DateTimeImmutable
    {
        return $this->moldingDay;
    }

    public function setmoldingDay(\DateTimeImmutable $moldingDay): self
    {
        $this->moldingDay = $moldingDay;

        return $this;
    }

    public function getaCuireAv(): ?\DateTimeImmutable
    {
        return $this->aCuireAv;
    }

    public function setaCuireAv(\DateTimeImmutable $aCuireAv): self
    {
        $this->aCuireAv = $aCuireAv;

        return $this;
    }

    public function getaDraperAv(): ?\DateTimeImmutable
    {
        return $this->aDraperAv;
    }

    public function setaDraperAv(?\DateTimeImmutable $aDraperAv): self
    {
        $this->raDraperAv = $aDraperAv;

        return $this;
    }

    public function getmatPolym(): ?DatasKits
    {
        return $this->matPolym;
    }

    public function setmatPolym(?DatasKits $matPolym): self
    {
        $this->matPolym = $matPolym;

        return $this;
    }

    public function getmatDrap(): ?DatasKits
    {
        return $this->matDrap;
    }

    public function setmatDrap(?DatasKits $matDrap): self
    {
        $this->matDrap = $matDrap;

        return $this;
    }

    public function getcreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setcreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getupdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setupdatedAt(?\DateTimeImmutable $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
}
