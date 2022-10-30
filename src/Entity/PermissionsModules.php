<?php

namespace App\Entity;

use App\Repository\PermissionsModulesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PermissionsModulesRepository::class)]
class PermissionsModules
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $who = null;

    #[ORM\Column]
    private ?bool $is_permit = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $created_at = null;

    #[ORM\ManyToOne(inversedBy: 'permissionsModules')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Modules $modules = null;

    #[ORM\ManyToOne(inversedBy: 'structure_id')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Structures $structures;

    #[ORM\ManyToOne(inversedBy: 'franchise_id')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Franchises $franchises;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getWho(): ?string
    {
        return $this->who;
    }

    public function setWho(string $who): self
    {
        $this->who = $who;

        return $this;
    }

    public function isIsPermit(): ?bool
    {
        return $this->is_permit;
    }

    public function setIsPermit(bool $is_permit): self
    {
        $this->is_permit = $is_permit;

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

    public function getModules(): ?Modules
    {
        return $this->modules;
    }

    public function setModules(?Modules $modules): self
    {
        $this->modules = $modules;

        return $this;
    }

    public function getStructures(): ?Structures
    {
        return $this->structures;
    }

    public function setStructures(?Structures $structures): self
    {
        $this->structures = $structures;

        return $this;
    }

    public function getFranchises(): ?Franchises
    {
        return $this->franchises;
    }

    public function setFranchises(?Franchises $franchises): self
    {
        $this->franchises = $franchises;

        return $this;
    }
}
