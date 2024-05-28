<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\JouerRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: JouerRepository::class)]
#[ApiResource]
class Jouer
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: Eleve::class, inversedBy: 'jouers')]
    #[ORM\JoinColumn(nullable: false)]
    private ?eleve $id_eleve = null;

    #[ORM\ManyToOne(targetEntity: Quiz::class, inversedBy: 'jouers')]
    #[ORM\JoinColumn(nullable: false)]
    private ?quiz $id_quiz = null;

    #[ORM\Column]
    private ?int $score = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_jeu = null;

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

    public function getIdQuiz(): ?quiz
    {
        return $this->id_quiz;
    }

    public function setIdQuiz(?quiz $id_quiz): static
    {
        $this->id_quiz = $id_quiz;

        return $this;
    }

    public function getScore(): ?int
    {
        return $this->score;
    }

    public function setScore(int $score): static
    {
        $this->score = $score;

        return $this;
    }

    public function getDateJeu(): ?\DateTimeInterface
    {
        return $this->date_jeu;
    }

    public function setDateJeu(\DateTimeInterface $date_jeu): static
    {
        $this->date_jeu = $date_jeu;

        return $this;
    }
}
