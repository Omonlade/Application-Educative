<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\ProjetRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProjetRepository::class)]
#[ApiResource]
class Projet
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_creation = null;



    /** 
     * @var Collection<int, Utiliser>
     */
    #[ORM\OneToMany(targetEntity: Utiliser::class, mappedBy: 'projet')]
    private Collection $utilisers;


    #[ORM\Column(type: Types::TEXT)]
    private ?string $image = null;

    #[ORM\OneToOne(targetEntity: Tutoriel::class, cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Tutoriel $tutoriel = null;

    /**
     * @var Collection<int, Consulter>
     */
    #[ORM\OneToMany(targetEntity: Consulter::class, mappedBy: 'projet')]
    private Collection $consulters;

    public function __construct()
    {
        $this->utilisers = new ArrayCollection();
        $this->consulters = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;
        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;
        return $this;
    }

    public function getDateCreation(): ?\DateTimeInterface
    {
        return $this->date_creation;
    }

    public function setDateCreation(\DateTimeInterface $date_creation): static
    {
        $this->date_creation = $date_creation;
        return $this;
    }

    /**
     * @return Collection<int, Utiliser>
     */
    public function getUtilisers(): Collection
    {
        return $this->utilisers;
    }

    public function addUtiliser(Utiliser $utiliser): static
    {
        if (!$this->utilisers->contains($utiliser)) {
            $this->utilisers->add($utiliser);
            $utiliser->setProjet($this);
        }
        return $this;
    }

    public function removeUtiliser(Utiliser $utiliser): static
    {
        if ($this->utilisers->removeElement($utiliser)) {
            // set the owning side to null (unless already changed)
            if ($utiliser->getProjet() === $this) {
                $utiliser->setProjet(null);
            }
        }
        return $this;
    }


    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): static
    {
        $this->image = $image;

        return $this;
    }

    public function getTutoriel(): ?Tutoriel
    {
        return $this->tutoriel;
    }

    public function setTutoriel(Tutoriel $tutoriel): static
    {
        $this->tutoriel = $tutoriel;

        return $this;
    }

    /**
     * @return Collection<int, Consulter>
     */
    public function getConsulters(): Collection
    {
        return $this->consulters;
    }

    public function addConsulter(Consulter $consulter): static
    {
        if (!$this->consulters->contains($consulter)) {
            $this->consulters->add($consulter);
            $consulter->setProjet($this);
        }

        return $this;
    }

    public function removeConsulter(Consulter $consulter): static
    {
        if ($this->consulters->removeElement($consulter)) {
            // set the owning side to null (unless already changed)
            if ($consulter->getProjet() === $this) {
                $consulter->setProjet(null);
            }
        }

        return $this;
    }
}
