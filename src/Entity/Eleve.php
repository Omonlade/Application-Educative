<?php


namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\EleveRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;


#[ORM\Entity(repositoryClass: EleveRepository::class)]
#[ApiResource()]
class Eleve implements PasswordAuthenticatedUserInterface 
{
    
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $prenom = null;

    #[ORM\Column(length: 255)]
    private ?string $pseudo = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_naissance = null;

    #[ORM\Column(length: 1)]
    private ?string $sexe = null;

    #[ORM\Column(length: 255)]
    private ?string $password = null;




    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $image = null;

    /**
     * @var Collection<int, Utiliser>
     */
    #[ORM\OneToMany(targetEntity: Utiliser::class, mappedBy: 'eleve',cascade: ['persist', 'remove'])]
    private Collection $utilisers;

    /**
     * @var Collection<int, Jouer>
     */
    #[ORM\OneToMany(targetEntity: Jouer::class, mappedBy: 'eleve',cascade: ['persist', 'remove'])]
    private Collection $jouers;

    /**
     * @var Collection<int, Consulter>
     */
    #[ORM\OneToMany(targetEntity: Consulter::class, mappedBy: 'eleve',cascade: ['persist', 'remove'])]
    private Collection $consulters;

    public function __construct()
    {
        $this->utilisers = new ArrayCollection();
        $this->jouers = new ArrayCollection();
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

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): static
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getPseudo(): ?string
    {
        return $this->pseudo;
    }

    public function setPseudo(string $pseudo): static
    {
        $this->pseudo = $pseudo;

        return $this;
    }

    public function getDateNaissance(): ?\DateTimeInterface
    {
        return $this->date_naissance;
    }

    public function setDateNaissance(\DateTimeInterface $date_naissance): static
    {
        $this->date_naissance = $date_naissance;

        return $this;
    }

    public function getSexe(): ?string
    {
        return $this->sexe;
    }

    public function setSexe(string $sexe): static
    {
        $this->sexe = $sexe;

        return $this;
    }

    // Implémentation de la méthode requise par PasswordAuthenticatedUserInterface
    public function getPassword(): ?string
    {
        return $this->password;
    }


    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    
    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): static
    {
        $this->image = $image;

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
            $utiliser->setEleve($this);
        }

        return $this;
    }

    public function removeUtiliser(Utiliser $utiliser): static
    {
        if ($this->utilisers->removeElement($utiliser)) {
            // set the owning side to null (unless already changed)
            if ($utiliser->getEleve() === $this) {
                $utiliser->setEleve(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Jouer>
     */
    public function getJouers(): Collection
    {
        return $this->jouers;
    }

    public function addJouer(Jouer $jouer): static
    {
        if (!$this->jouers->contains($jouer)) {
            $this->jouers->add($jouer);
            $jouer->setEleve($this);
        }

        return $this;
    }

    public function removeJouer(Jouer $jouer): static
    {
        if ($this->jouers->removeElement($jouer)) {
            // set the owning side to null (unless already changed)
            if ($jouer->getEleve() === $this) {
                $jouer->setEleve(null);
            }
        }

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
            $consulter->setEleve($this);
        }

        return $this;
    }

    public function removeConsulter(Consulter $consulter): static
    {
        if ($this->consulters->removeElement($consulter)) {
            // set the owning side to null (unless already changed)
            if ($consulter->getEleve() === $this) {
                $consulter->setEleve(null);
            }
        }

        return $this;
    }
}
