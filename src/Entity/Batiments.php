<?php

namespace App\Entity;

use App\Repository\BatimentsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BatimentsRepository::class)
 */
class Batiments
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
    private $code_batiment;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbr_salles;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbr_etages;

    /**
     * @ORM\Column(type="boolean")
     */
    private $acsenseur;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $photo;

    /**
     * @ORM\ManyToOne(targetEntity=Agences::class, inversedBy="batiments")
     */
    private $Agences;

    /**
     * @ORM\OneToMany(targetEntity=Salles::class, mappedBy="Batiments")
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

    public function getCodeBatiment(): ?string
    {
        return $this->code_batiment;
    }

    public function setCodeBatiment(string $code_batiment): self
    {
        $this->code_batiment = $code_batiment;

        return $this;
    }

    public function getNbrSalles(): ?int
    {
        return $this->nbr_salles;
    }

    public function setNbrSalles(int $nbr_salles): self
    {
        $this->nbr_salles = $nbr_salles;

        return $this;
    }

    public function getNbrEtages(): ?int
    {
        return $this->nbr_etages;
    }

    public function setNbrEtages(int $nbr_etages): self
    {
        $this->nbr_etages = $nbr_etages;

        return $this;
    }

    public function getAcsenseur(): ?bool
    {
        return $this->acsenseur;
    }

    public function setAcsenseur(bool $acsenseur): self
    {
        $this->acsenseur = $acsenseur;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(string $photo): self
    {
        $this->photo = $photo;

        return $this;
    }

    public function getAgences(): ?Agences
    {
        return $this->Agences;
    }

    public function setAgences(?Agences $Agences): self
    {
        $this->Agences = $Agences;

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
            $salle->setBatiments($this);
        }

        return $this;
    }

    public function removeSalle(Salles $salle): self
    {
        if ($this->salles->removeElement($salle)) {
            // set the owning side to null (unless already changed)
            if ($salle->getBatiments() === $this) {
                $salle->setBatiments(null);
            }
        }

        return $this;
    }
}
