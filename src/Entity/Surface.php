<?php

namespace App\Entity;

use App\Repository\SurfaceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SurfaceRepository::class)
 */
class Surface
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
    private $nbr_m2;

    /**
     * @ORM\OneToMany(targetEntity=Salles::class, mappedBy="Surface")
     */
    private $salles;

    public function __construct()
    {
        $this->salles = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNbrM2(): ?int
    {
        return $this->nbr_m2;
    }

    public function setNbrM2(int $nbr_m2): self
    {
        $this->nbr_m2 = $nbr_m2;

        return $this;
    }

    /**
     * @return Collection|Salles[]
     */
    public function getSalles(): Collection
    {
        return $this->salles;
    }

    public function addSalle(Salles $salle): self
    {
        if (!$this->salles->contains($salle)) {
            $this->salles[] = $salle;
            $salle->setSurface($this);
        }

        return $this;
    }

    public function removeSalle(Salles $salle): self
    {
        if ($this->salles->removeElement($salle)) {
            // set the owning side to null (unless already changed)
            if ($salle->getSurface() === $this) {
                $salle->setSurface(null);
            }
        }

        return $this;
    }
}
