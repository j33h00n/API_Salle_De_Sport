<?php

namespace App\Entity;

use App\Repository\FranchisesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

#[UniqueEntity("ville")]
#[ORM\Entity(repositoryClass: FranchisesRepository::class)]
class Franchises
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $ville = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $created_at = null;

    #[ORM\OneToMany(mappedBy: 'franchises', targetEntity: PermissionsModules::class, orphanRemoval: true)]
    private Collection $franchise_id;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Users $user = null;

    #[ORM\Column(nullable: true)]
    private ?int $structure_id = null;

    public function __construct()
    {
        $this->franchise_id = new ArrayCollection();
        $this->created_at = new \DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): self
    {
        $this->ville = $ville;

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

    /**
     * @return Collection<int, PermissionsModules>
     */
    public function getFranchiseId(): Collection
    {
        return $this->franchise_id;
    }

    public function addFranchiseId(PermissionsModules $franchiseId): self
    {
        if (!$this->franchise_id->contains($franchiseId)) {
            $this->franchise_id->add($franchiseId);
            $franchiseId->setFranchises($this);
        }

        return $this;
    }

    public function removeFranchiseId(PermissionsModules $franchiseId): self
    {
        if ($this->franchise_id->removeElement($franchiseId)) {
            // set the owning side to null (unless already changed)
            if ($franchiseId->getFranchises() === $this) {
                $franchiseId->setFranchises(null);
            }
        }

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

    public function getStructureId(): ?int
    {
        return $this->structure_id;
    }

    public function setStructureId(?int $structure_id): self
    {
        $this->structure_id = $structure_id;

        return $this;
    }
}
