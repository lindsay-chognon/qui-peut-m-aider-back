<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\PrestationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: PrestationRepository::class)]
#[ApiResource(normalizationContext: ['groups' => ['prestation']])]
class Prestation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups('prestation')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups('prestation')]
    private $titre;

    #[ORM\Column(type: 'text')]
    #[Groups('prestation')]
    private $description;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Groups('prestation')]
    private $photo;

    #[ORM\Column(type: 'float')]
    #[Groups('prestation')]
    private $taux_horaire;

    #[ORM\Column(type: 'integer')]
    #[Groups('prestation')]
    private $statut;

    #[ORM\OneToMany(mappedBy: 'prestation', targetEntity: Disponibilites::class, orphanRemoval: true)]
    #[Groups('prestation')]
    private $disponibilites;

    #[ORM\OneToMany(mappedBy: 'prestation', targetEntity: Jour::class, orphanRemoval: true)]
    #[Groups('prestation')]
    private $jours;

    #[ORM\ManyToOne(targetEntity: Categorie::class, inversedBy: 'prestations')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups('prestation')]
    private $categorie;

    #[ORM\OneToMany(mappedBy: 'prestation', targetEntity: Reservation::class, orphanRemoval: true)]
    #[Groups('prestation')]
    private $reservations;

    #[ORM\ManyToOne(targetEntity: Ville::class, inversedBy: 'prestations')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups('prestation')]
    private $ville;

    public function __construct()
    {
        $this->disponibilites = new ArrayCollection();
        $this->jours = new ArrayCollection();
        $this->reservations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

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

    public function setPhoto(?string $photo): self
    {
        $this->photo = $photo;

        return $this;
    }

    public function getTauxHoraire(): ?float
    {
        return $this->taux_horaire;
    }

    public function setTauxHoraire(float $taux_horaire): self
    {
        $this->taux_horaire = $taux_horaire;

        return $this;
    }

    public function getStatut(): ?int
    {
        return $this->statut;
    }

    public function setStatut(int $statut): self
    {
        $this->statut = $statut;

        return $this;
    }

    /**
     * @return Collection<int, Disponibilites>
     */
    public function getDisponibilites(): Collection
    {
        return $this->disponibilites;
    }

    public function addDisponibilite(Disponibilites $disponibilite): self
    {
        if (!$this->disponibilites->contains($disponibilite)) {
            $this->disponibilites[] = $disponibilite;
            $disponibilite->setPrestation($this);
        }

        return $this;
    }

    public function removeDisponibilite(Disponibilites $disponibilite): self
    {
        if ($this->disponibilites->removeElement($disponibilite)) {
            // set the owning side to null (unless already changed)
            if ($disponibilite->getPrestation() === $this) {
                $disponibilite->setPrestation(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Jour>
     */
    public function getJours(): Collection
    {
        return $this->jours;
    }

    public function addJour(Jour $jour): self
    {
        if (!$this->jours->contains($jour)) {
            $this->jours[] = $jour;
            $jour->setPrestation($this);
        }

        return $this;
    }

    public function removeJour(Jour $jour): self
    {
        if ($this->jours->removeElement($jour)) {
            // set the owning side to null (unless already changed)
            if ($jour->getPrestation() === $this) {
                $jour->setPrestation(null);
            }
        }

        return $this;
    }

    public function getCategorie(): ?Categorie
    {
        return $this->categorie;
    }

    public function setCategorie(Categorie $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * @return Collection<int, Reservation>
     */
    public function getReservations(): Collection
    {
        return $this->reservations;
    }

    public function addReservation(Reservation $reservation): self
    {
        if (!$this->reservations->contains($reservation)) {
            $this->reservations[] = $reservation;
            $reservation->setPrestation($this);
        }

        return $this;
    }

    public function removeReservation(Reservation $reservation): self
    {
        if ($this->reservations->removeElement($reservation)) {
            // set the owning side to null (unless already changed)
            if ($reservation->getPrestation() === $this) {
                $reservation->setPrestation(null);
            }
        }

        return $this;
    }

    public function getVille(): ?Ville
    {
        return $this->ville;
    }

    public function setVille(?Ville $ville): self
    {
        $this->ville = $ville;

        return $this;
    }
}
