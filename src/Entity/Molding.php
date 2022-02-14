<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\MoldingRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *      normalizationContext={"groups"={"user:read"}},
 *      denormalizationContext={"groups"={"user:write"}},
 * )
 * @ORM\Entity(repositoryClass=MoldingRepository::class)
 */
class Molding
{
    /**
     * @Groups({"user:read"})
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Groups({"user:read", "user:write"})
     * @ORM\ManyToMany(targetEntity=DatasKits::class, inversedBy="moldings")
     */
    private $kits;

    /**
     * @Groups({"user:read", "user:write"})
     * @ORM\Column(type="datetime_immutable")
     */
    private $moldingDay;

    /**
     * @Groups({"user:read", "user:write"})
     * @ORM\Column(type="datetime_immutable")
     */
    private $aCuireAv;

    /**
     * @Groups({"user:read", "user:write"})
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    private $aDraperAv;

    /**
     * @Groups({"user:read", "user:write"})
     * @ORM\ManyToOne(targetEntity=DatasKits::class, inversedBy="moldings")
     * @ORM\JoinColumn(nullable=false)
     */
    private $matPolym;

    /**
     * @Groups({"user:read", "user:write"})
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
