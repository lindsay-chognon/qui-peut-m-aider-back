<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\VilleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: VilleRepository::class)]
#[ApiResource]
class Ville
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups('prestation')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups('prestation')]
    private $ville;

    #[ORM\Column(type: 'integer')]
    #[Groups('prestation')]
    private $code_postal;

    #[ORM\OneToMany(mappedBy: 'ville', targetEntity: Prestation::class)]
    #[Groups('prestation')]
    private $prestations;

    #[ORM\OneToMany(mappedBy: 'ville', targetEntity: Adresse::class)]
    #[Groups('prestation')]
    private $adresses;

    #[ORM\Column(length: 5)]
    private ?string $code_commune = null;

    public function __construct()
    {
        $this->prestations = new ArrayCollection();
        $this->adresses = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function getCodePostal(): ?int
    {
        return $this->code_postal;
    }

    public function setCodePostal(int $code_postal): self
    {
        $this->code_postal = $code_postal;

        return $this;
    }

    /**
     * @return Collection<int, Prestation>
     */
    public function getPrestations(): Collection
    {
        return $this->prestations;
    }

    public function addPrestation(Prestation $prestation): self
    {
        if (!$this->prestations->contains($prestation)) {
            $this->prestations[] = $prestation;
            $prestation->setVille($this);
        }

        return $this;
    }

    public function removePrestation(Prestation $prestation): self
    {
        if ($this->prestations->removeElement($prestation)) {
            // set the owning side to null (unless already changed)
            if ($prestation->getVille() === $this) {
                $prestation->setVille(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Adresse>
     */
    public function getAdresses(): Collection
    {
        return $this->adresses;
    }

    public function addAdress(Adresse $adress): self
    {
        if (!$this->adresses->contains($adress)) {
            $this->adresses[] = $adress;
            $adress->setVille($this);
        }

        return $this;
    }

    public function removeAdress(Adresse $adress): self
    {
        if ($this->adresses->removeElement($adress)) {
            // set the owning side to null (unless already changed)
            if ($adress->getVille() === $this) {
                $adress->setVille(null);
            }
        }

        return $this;
    }

    public function getCodeCommune(): ?string
    {
        return $this->code_commune;
    }

    public function setCodeCommune(string $code_commune): self
    {
        $this->code_commune = $code_commune;

        return $this;
    }
}
