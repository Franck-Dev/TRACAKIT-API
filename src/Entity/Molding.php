<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\MoldingRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ApiResource(
 *      normalizationContext={"groups"={"layer:read", "OT:read", "kit:read"}},
 *      denormalizationContext={"groups"={"layer:write"}},
 *      collectionOperations={
 *              "get",
 *              "post"={"security"="is_granted('ROLE_USER')"}
 *      },
 *      itemOperations={"get","put"={"security"="is_granted('ROLE_USER')"},
 *                      "patch"={"security"="is_granted('ROLE_USER')"},
 *                      "delete"={"security"="is_granted('ROLE_USER')"}},
 *      order={"id" ="DESC"}
 * )
 * @ORM\Entity(repositoryClass=MoldingRepository::class)
 */
class Molding
{
    /**
     * @Groups({"layer:read"})
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Assert\NotBlank()
     * @Groups({"layer:read", "layer:write", "kit:read"})
     * @ORM\ManyToMany(targetEntity=DatasKits::class, inversedBy="moldings")
     */
    private $kits;

    /**
     * @Assert\NotBlank()
     * @Groups({"layer:read", "layer:write"})
     * @ORM\Column(type="datetime_immutable")
     */
    private $moldingDay;

    /**
     * @Assert\NotBlank()
     * @Groups({"layer:read", "layer:write"})
     * @ORM\Column(type="datetime_immutable")
     */
    private $aCuireAv;

    /**
     * @Groups({"layer:read", "layer:write"})
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    private $aDraperAv;

    /**
     * @Groups({"layer:read", "layer:write", "kit:edit"})
     * @ORM\ManyToOne(targetEntity=DatasKits::class, inversedBy="moldings")
     * @ORM\JoinColumn(nullable=false)
     */
    private $matPolym;

    /**
     * @Groups({"layer:read", "layer:write",  "kit:edit"})
     * @ORM\ManyToOne(targetEntity=DatasKits::class, inversedBy="moldings")
     * @ORM\JoinColumn(nullable=false)
     */
    private $matDrap;

    /**
     * @Groups({"layer:read"})
     * @ORM\Column(type="datetime_immutable")
     */
    private $createdAt;

    /**
     * @Groups({"layer:read"})
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    private $updatedAt;

    /**
     * @Assert\NotBlank()
     * @Groups({"layer:read", "layer:write", "OT:read"})
     * @ORM\Column(type="string", length=255)
     */
    private $outillage;

    /**
     * @Groups({"layer:read"})
     * @ORM\Column(type="string", length=255)
     */
    private $createdBy;

    /**
     * @Groups({"layer:read"})
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $modifiedBy;

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
        $this->aDraperAv = $aDraperAv;

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

    public function getOutillage(): ?string
    {
        return $this->outillage;
    }

    public function setOutillage(?string $outillage): self
    {
        $this->outillage = $outillage;

        return $this;
    }
    

    public function getCreatedBy(): ?string
    {
        return $this->createdBy;
    }

    public function setCreatedBy(?string $createdBy): self
    {
        $this->createdBy = $createdBy;

        return $this;
    }

    public function getModifiedBy(): ?string
    {
        return $this->modifiedBy;
    }

    public function setModifiedBy(?string $modifiedBy): self
    {
        $this->modifiedBy = $modifiedBy;

        return $this;
    }
}
