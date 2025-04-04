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



    #[ORM\Column]
    private ?string $score = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_jeu = null;

    #[ORM\ManyToOne(targetEntity: Quiz::class, inversedBy: 'jouers',cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Quiz $quiz = null;

    #[ORM\ManyToOne(targetEntity: Eleve::class, inversedBy: 'jouers',cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Eleve $eleve = null;

    public function getId(): ?int
    {
        return $this->id;
    }




    public function getScore(): ?string
    {
        return $this->score;
    }

    public function setScore(?string $score): static
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

    public function getQuiz(): ?Quiz
    {
        return $this->quiz;
    }

    public function setQuiz(?Quiz $quiz): static
    {
        $this->quiz = $quiz;

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
}
