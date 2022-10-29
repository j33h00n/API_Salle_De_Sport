<?php

namespace App\Entity;

use App\Repository\StructuresRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StructuresRepository::class)]
class Structures
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $adresse = null;

    #[ORM\Column]
    private ?bool $is_active = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $created_at = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Users $user = null;

    #[ORM\OneToMany(mappedBy: 'structures', targetEntity: PermissionsModules::class, orphanRemoval: true)]
    private Collection $structure_id;

    public function __construct()
    {
        $this->structure_id = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function isIsActive(): ?bool
    {
        return $this->is_active;
    }

    public function setIsActive(bool $is_active): self
    {
        $this->is_active = $is_active;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeImmutable $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getUser(): ?Users
    {
        return $this->user;
    }

    public function setUser(Users $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection<int, PermissionsModules>
     */
    public function getStructureId(): Collection
    {
        return $this->structure_id;
    }

    public function addStructureId(PermissionsModules $structureId): self
    {
        if (!$this->structure_id->contains($structureId)) {
            $this->structure_id->add($structureId);
            $structureId->setStructures($this);
        }

        return $this;
    }

    public function removeStructureId(PermissionsModules $structureId): self
    {
        if ($this->structure_id->removeElement($structureId)) {
            // set the owning side to null (unless already changed)
            if ($structureId->getStructures() === $this) {
                $structureId->setStructures(null);
            }
        }

        return $this;
    }

    public function getFranchises(): ?string
    {
        return $this->Franchises;
    }

    public function setFranchises(string $Franchises): self
    {
        $this->Franchises = $Franchises;

        return $this;
    }
}
