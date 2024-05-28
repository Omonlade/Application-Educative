<?php

namespace App\Entity;

use App\Entity\ProjetEntity;
use ApiPlatform\Metadata\ApiResource;
use App\Repository\UtiliserRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UtiliserRepository::class)]
#[ApiResource]
class Utiliser
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: Projet::class, inversedBy: 'utilisers')]
    #[ORM\JoinColumn(nullable: false)]
    private ?projet $id_projet = null;

    #[ORM\ManyToOne(targetEntity: Equipement::class, inversedBy: 'utilisers')]
    #[ORM\JoinColumn(nullable: false)]
    private ?equipement $id_equipement = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getIdEquipement(): ?equipement
    {
        return $this->id_equipement;
    }

    public function setIdEquipement(?equipement $id_equipement): static
    {
        $this->id_equipement = $id_equipement;

        return $this;
    }
}
