<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\ConsulterRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Eleve;


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

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_consulter = null;

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

    public function getDateConsulter(): ?\DateTimeInterface
    {
        return $this->date_consulter;
    }

    public function setDateConsulter(\DateTimeInterface $date_consulter): static
    {
        $this->date_consulter = $date_consulter;

        return $this;
    }
}
