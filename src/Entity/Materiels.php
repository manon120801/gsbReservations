<?php

namespace App\Entity;

use App\Repository\MaterielsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MaterielsRepository::class)
 */
class Materiels
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
     * @ORM\ManyToOne(targetEntity=Salles::class, inversedBy="materiels")
     */
    private $Salles;

    /**
     * @ORM\ManyToOne(targetEntity=TypeMateriels::class, inversedBy="materiels")
     */
    private $Type_Materiels;

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

    public function getSalles(): ?Salles
    {
        return $this->Salles;
    }

    public function setSalles(?Salles $Salles): self
    {
        $this->Salles = $Salles;

        return $this;
    }

    public function getTypeMateriels(): ?TypeMateriels
    {
        return $this->Type_Materiels;
    }

    public function setTypeMateriels(?TypeMateriels $Type_Materiels): self
    {
        $this->Type_Materiels = $Type_Materiels;

        return $this;
    }
}
