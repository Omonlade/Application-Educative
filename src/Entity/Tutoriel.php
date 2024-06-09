<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\TutorielRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;


#[ORM\Entity(repositoryClass: TutorielRepository::class)]
#[ApiResource]
class Tutoriel
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $titre = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $video = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_ajout = null;
    
    
    #[ORM\ManyToOne(targetEntity: Projet::class, inversedBy: "tutoriels", cascade: ['persist', 'remove'])]
    private ?Projet $projet = null;


    public function getId():?int
    {
        return $this->id;
    }

    public function getTitre():?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;
        return $this;
    }

    public function getDescription():?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;
        return $this;
    }

    public function getVideo():?string
    {
        return $this->video;
    }

    public function setVideo(string $video): self
    {
        $this->video = $video;
        return $this;
    }

    public function getDateAjout(): ?\DateTimeInterface
    {
        return $this->date_ajout;
    }

    public function setDateAjout(\DateTimeInterface $date_ajout): static
    {
        $this->date_ajout = $date_ajout;

        return $this;
    }


    public function getProjet():?Projet
    {
        return $this->projet;
    }

    public function setProjet(?Projet $projet): self {
        $this->projet = $projet;
    
        return $this;
    }
}
