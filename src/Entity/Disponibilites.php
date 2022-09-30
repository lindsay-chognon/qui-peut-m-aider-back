<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\DisponibilitesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DisponibilitesRepository::class)]
#[ApiResource]
class Disponibilites
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(targetEntity: Prestation::class, inversedBy: 'disponibilites')]
    #[ORM\JoinColumn(nullable: false)]
    private $prestation;

    #[ORM\OneToOne(mappedBy: 'disponibilite', targetEntity: Jour::class, cascade: ['persist', 'remove'])]
    private $jour;

    #[ORM\Column(type: 'datetime')]
    private $datetime_debut;

    #[ORM\Column(type: 'datetime')]
    private $datetime_fin;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getJour(): ?Jour
    {
        return $this->jour;
    }

    public function setJour(Jour $jour): self
    {
        // set the owning side of the relation if necessary
        if ($jour->getDisponibilite() !== $this) {
            $jour->setDisponibilite($this);
        }

        $this->jour = $jour;

        return $this;
    }

    public function getDatetimeDebut(): ?\DateTimeInterface
    {
        return $this->datetime_debut;
    }

    public function setDatetimeDebut(\DateTimeInterface $datetime_debut): self
    {
        $this->datetime_debut = $datetime_debut;

        return $this;
    }

    public function getDatetimeFin(): ?\DateTimeInterface
    {
        return $this->datetime_fin;
    }

    public function setDatetimeFin(\DateTimeInterface $datetime_fin): self
    {
        $this->datetime_fin = $datetime_fin;

        return $this;
    }
}
