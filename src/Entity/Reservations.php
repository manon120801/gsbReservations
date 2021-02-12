<?php

namespace App\Entity;

use App\Repository\ReservationsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ReservationsRepository::class)
 */
class Reservations
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $date;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbr_personnes;

    /**
     * @ORM\Column(type="time")
     */
    private $heure_deb;

    /**
     * @ORM\Column(type="time")
     */
    private $heure_fin;

    /**
     * @ORM\ManyToOne(targetEntity=Utilisateurs::class, inversedBy="reservations")
     */
    private $Utilisateurs;

    /**
     * @ORM\ManyToOne(targetEntity=Salles::class, inversedBy="reservations")
     */
    private $Salles;

    /**
     * @ORM\ManyToOne(targetEntity=Extras::class, inversedBy="reservations")
     */
    private $Extras;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getNbrPersonnes(): ?int
    {
        return $this->nbr_personnes;
    }

    public function setNbrPersonnes(int $nbr_personnes): self
    {
        $this->nbr_personnes = $nbr_personnes;

        return $this;
    }

    public function getHeureDeb(): ?\DateTimeInterface
    {
        return $this->heure_deb;
    }

    public function setHeureDeb(\DateTimeInterface $heure_deb): self
    {
        $this->heure_deb = $heure_deb;

        return $this;
    }

    public function getHeureFin(): ?\DateTimeInterface
    {
        return $this->heure_fin;
    }

    public function setHeureFin(\DateTimeInterface $heure_fin): self
    {
        $this->heure_fin = $heure_fin;

        return $this;
    }

    public function getUtilisateurs(): ?Utilisateurs
    {
        return $this->Utilisateurs;
    }

    public function setUtilisateurs(?Utilisateurs $Utilisateurs): self
    {
        $this->Utilisateurs = $Utilisateurs;

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

    public function getExtras(): ?Extras
    {
        return $this->Extras;
    }

    public function setExtras(?Extras $Extras): self
    {
        $this->Extras = $Extras;

        return $this;
    }
}
