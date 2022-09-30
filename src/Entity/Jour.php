<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\JourRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: JourRepository::class)]
#[ApiResource]
class Jour
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'date')]
    private $jour_debut;

    #[ORM\ManyToOne(targetEntity: Prestation::class, inversedBy: 'jours')]
    #[ORM\JoinColumn(nullable: false)]
    private $prestation;

    #[ORM\Column(type: 'date')]
    private $jour_fin;

    #[ORM\OneToOne(inversedBy: 'jour', targetEntity: Disponibilites::class, cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private $disponibilite;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getJour_debut(): ?\DateTimeInterface
    {
        return $this->jour_debut;
    }

    public function setJour_debut(\DateTimeInterface $jour_debut): self
    {
        $this->jour_debut = $jour_debut;

        return $this;
    }

    public function getPrestation(): ?Prestation
    {
        return $this->prestation;
    }

    public function setPrestation(?Prestation $prestation): self
    {
        $this->prestation = $prestation;

        return $this;
    }

    public function getJourFin(): ?\DateTimeInterface
    {
        return $this->jour_fin;
    }

    public function setJourFin(\DateTimeInterface $jour_fin): self
    {
        $this->jour_fin = $jour_fin;

        return $this;
    }

    public function getDisponibilite(): ?Disponibilites
    {
        return $this->disponibilite;
    }

    public function setDisponibilite(Disponibilites $disponibilite): self
    {
        $this->disponibilite = $disponibilite;

        return $this;
    }
}
