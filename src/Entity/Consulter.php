<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\ConsulterRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ConsulterRepository::class)]
#[ApiResource]
class Consulter
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: Eleve::class, inversedBy: 'consulters')]
    #[ORM\JoinColumn(nullable: false)]
    private ?eleve $id_eleve = null;

    #[ORM\ManyToOne(targetEntity: Projet::class, inversedBy: 'consulters')]
    #[ORM\JoinColumn(nullable: false)]
    private ?projet $id_projet = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdEleve(): ?eleve
    {
        return $this->id_eleve;
    }

    public function setIdEleve(?eleve $id_eleve): static
    {
        $this->id_eleve = $id_eleve;

        return $this;
    }

    public function getIdProjet(): ?projet
    {
        return $this->id_projet;
    }

    public function setIdProjet(?projet $id_projet): static
    {
        $this->id_projet = $id_projet;

        return $this;
    }
}
