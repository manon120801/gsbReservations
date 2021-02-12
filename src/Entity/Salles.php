<?php

namespace App\Entity;

use App\Repository\SallesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SallesRepository::class)
 */
class Salles
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
    private $code_salle;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbr_chaises;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbr_tables;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $photo;

    /**
     * @ORM\ManyToOne(targetEntity=Batiments::class, inversedBy="salles")
     */
    private $Batiments;

    /**
     * @ORM\ManyToOne(targetEntity=Surface::class, inversedBy="salles")
     */
    private $Surface;

    /**
     * @ORM\OneToMany(targetEntity=Materiels::class, mappedBy="Salles")
     */
    private $materiels;

    /**
     * @ORM\OneToMany(targetEntity=Reservations::class, mappedBy="Salles")
     */
    private $reservations;

    public function __construct()
    {
        $this->materiels = new ArrayCollection();
        $this->reservations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCodeSalle(): ?string
    {
        return $this->code_salle;
    }

    public function setCodeSalle(string $code_salle): self
    {
        $this->code_salle = $code_salle;

        return $this;
    }

    public function getNbrChaises(): ?int
    {
        return $this->nbr_chaises;
    }

    public function setNbrChaises(int $nbr_chaises): self
    {
        $this->nbr_chaises = $nbr_chaises;

        return $this;
    }

    public function getNbrTables(): ?int
    {
        return $this->nbr_tables;
    }

    public function setNbrTables(int $nbr_tables): self
    {
        $this->nbr_tables = $nbr_tables;

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

    public function getBatiments(): ?Batiments
    {
        return $this->Batiments;
    }

    public function setBatiments(?Batiments $Batiments): self
    {
        $this->Batiments = $Batiments;

        return $this;
    }

    public function getSurface(): ?Surface
    {
        return $this->Surface;
    }

    public function setSurface(?Surface $Surface): self
    {
        $this->Surface = $Surface;

        return $this;
    }

    /**
     * @return Collection|Materiels[]
     */
    public function getMateriels(): Collection
    {
        return $this->materiels;
    }

    public function addMateriel(Materiels $materiel): self
    {
        if (!$this->materiels->contains($materiel)) {
            $this->materiels[] = $materiel;
            $materiel->setSalles($this);
        }

        return $this;
    }

    public function removeMateriel(Materiels $materiel): self
    {
        if ($this->materiels->removeElement($materiel)) {
            // set the owning side to null (unless already changed)
            if ($materiel->getSalles() === $this) {
                $materiel->setSalles(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Reservations[]
     */
    public function getReservations(): Collection
    {
        return $this->reservations;
    }

    public function addReservation(Reservations $reservation): self
    {
        if (!$this->reservations->contains($reservation)) {
            $this->reservations[] = $reservation;
            $reservation->setSalles($this);
        }

        return $this;
    }

    public function removeReservation(Reservations $reservation): self
    {
        if ($this->reservations->removeElement($reservation)) {
            // set the owning side to null (unless already changed)
            if ($reservation->getSalles() === $this) {
                $reservation->setSalles(null);
            }
        }

        return $this;
    }
}
