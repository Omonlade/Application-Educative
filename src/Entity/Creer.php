<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\CreerRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Quiz;


#[ORM\Entity(repositoryClass: CreerRepository::class)]
#[ApiResource]
class Creer
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'creers')]
    private ?user $id_user = null;

    #[ORM\ManyToOne(targetEntity: Quiz::class, inversedBy: 'creers')]
    #[ORM\JoinColumn(nullable: false)]
    private ?quiz $id_quiz = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_creation = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdUser(): ?user
    {
        return $this->id_user;
    }

    public function setIdUser(?user $id_user): static
    {
        $this->id_user = $id_user;

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

    public function getDateCreation(): ?\DateTimeInterface
    {
        return $this->date_creation;
    }

    public function setDateCreation(\DateTimeInterface $date_creation): static
    {
        $this->date_creation = $date_creation;

        return $this;
    }
}
