<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\PermissionsModules;
use App\Repository\ModulesRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ModulesRepository::class)]
#[UniqueEntity('name')]
class Modules
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $name = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $created_at = null;

    #[ORM\OneToMany(mappedBy: 'modules', targetEntity: PermissionsModules::class, orphanRemoval: true)]
    private Collection $permissionsModules;

    public function __construct()
    {
        $this->permissionsModules = new ArrayCollection();
        $this->created_at = new \DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

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
    public function getPermissionsModules(): Collection
    {
        return $this->permissionsModules;
    }

    public function addPermissionsModule(PermissionsModules $permissionsModule): self
    {
        if (!$this->permissionsModules->contains($permissionsModule)) {
            $this->permissionsModules->add($permissionsModule);
            $permissionsModule->setModules($this);
        }

        return $this;
    }

    public function removePermissionsModule(PermissionsModules $permissionsModule): self
    {
        if ($this->permissionsModules->removeElement($permissionsModule)) {
            // set the owning side to null (unless already changed)
            if ($permissionsModule->getModules() === $this) {
                $permissionsModule->setModules(null);
            }
        }

        return $this;
    }

}
