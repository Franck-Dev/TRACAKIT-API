<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\MoldingToolRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=MoldingToolRepository::class)
 */
class MoldingTool
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $sapToolNumber;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $designation;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $identification;

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
}
