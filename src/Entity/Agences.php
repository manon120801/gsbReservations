<?php

namespace App\Entity;

use App\Repository\AgencesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AgencesRepository::class)
 */
class Agences
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\OneToMany(targetEntity=Utilisateurs::class, mappedBy="Agence")
     */
    private $utilisateurs;

    /**
     * @ORM\ManyToOne(targetEntity=Regions::class, inversedBy="agences")
     */
    private $Regions;

    /**
     * @ORM\OneToMany(targetEntity=Batiments::class, mappedBy="Agences")
     */
    private $batiments;

    public function __construct()
    {
        $this->utilisateurs = new ArrayCollection();
        $this->batiments = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * @return Collection|Utilisateurs[]
     */
    public function getUtilisateurs(): Collection
    {
        return $this->utilisateurs;
    }

    public function addUtilisateur(Utilisateurs $utilisateur): self
    {
        if (!$this->utilisateurs->contains($utilisateur)) {
            $this->utilisateurs[] = $utilisateur;
            $utilisateur->setAgence($this);
        }

        return $this;
    }

    public function removeUtilisateur(Utilisateurs $utilisateur): self
    {
        if ($this->utilisateurs->removeElement($utilisateur)) {
            // set the owning side to null (unless already changed)
            if ($utilisateur->getAgence() === $this) {
                $utilisateur->setAgence(null);
            }
        }

        return $this;
    }

    public function getRegions(): ?Regions
    {
        return $this->Regions;
    }

    public function setRegions(?Regions $Regions): self
    {
        $this->Regions = $Regions;

        return $this;
    }

    /**
     * @return Collection|Batiments[]
     */
    public function getBatiments(): Collection
    {
        return $this->batiments;
    }

    public function addBatiment(Batiments $batiment): self
    {
        if (!$this->batiments->contains($batiment)) {
            $this->batiments[] = $batiment;
            $batiment->setAgences($this);
        }

        return $this;
    }

    public function removeBatiment(Batiments $batiment): self
    {
        if ($this->batiments->removeElement($batiment)) {
            // set the owning side to null (unless already changed)
            if ($batiment->getAgences() === $this) {
                $batiment->setAgences(null);
            }
        }

        return $this;
    }
}
