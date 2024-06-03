<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\ConsulterRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Eleve;
use App\Entity\Projet;


#[ORM\Entity(repositoryClass: ConsulterRepository::class)]
#[ApiResource]
class Consulter
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;



    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_consulter = null;

    #[ORM\ManyToOne(targetEntity: Eleve::class, inversedBy: 'consulters')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Eleve $eleve = null;

    #[ORM\ManyToOne(targetEntity: Projet::class, inversedBy: 'consulters')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Projet $projet = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getEleve(): ?Eleve
    {
        return $this->eleve;
    }

    public function setEleve(?Eleve $eleve): static
    {
        $this->eleve = $eleve;

        return $this;
    }

    public function getProjet(): ?Projet
    {
        return $this->projet;
    }

    public function setProjet(?Projet $projet): static
    {
        $this->projet = $projet;

        return $this;
    }
}
