<?php

namespace App\Entity;

use App\Repository\QuizRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

use ApiPlatform\Metadata\ApiResource;
#[ApiResource()]

#[ORM\Entity(repositoryClass: QuizRepository::class)]
class Quiz
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $libelle = null;

    /**
     * @var Collection<int, Question>
     */
    #[ORM\OneToMany(targetEntity: Question::class, mappedBy: 'id_quiz')]
    private Collection $questions;


    /**
     * @var Collection<int, Jouer>
     */
    #[ORM\OneToMany(targetEntity: Jouer::class, mappedBy: 'quiz')]
    private Collection $jouers;

    /**
     * @var Collection<int, Creer>
     */
    #[ORM\OneToMany(targetEntity: Creer::class, mappedBy: 'quiz')]
    private Collection $creers;

    public function __construct()
    {
        $this->questions = new ArrayCollection();
        $this->jouers = new ArrayCollection();
        $this->creers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): static
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * @return Collection<int, Question>
     */
    public function getQuestions(): Collection
    {
        return $this->questions;
    }

    public function addQuestion(Question $question): static
    {
        if (!$this->questions->contains($question)) {
            $this->questions->add($question);
            $question->setQuiz($this);
        }

        return $this;
    }

    public function removeQuestion(Question $question): static
    {
        if ($this->questions->removeElement($question)) {
            // set the owning side to null (unless already changed)
            if ($question->getQuiz() === $this) {
                $question->setQuiz(null);
            }
        }

        return $this;
    }



    public function __toString(): string
    {
        // Utilisez la propriété $libelle pour représenter l'objet Quiz sous forme de chaîne.
        return $this->libelle?? '';
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
            $jouer->setQuiz($this);
        }

        return $this;
    }

    public function removeJouer(Jouer $jouer): static
    {
        if ($this->jouers->removeElement($jouer)) {
            // set the owning side to null (unless already changed)
            if ($jouer->getQuiz() === $this) {
                $jouer->setQuiz(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Creer>
     */
    public function getCreers(): Collection
    {
        return $this->creers;
    }

    public function addCreer(Creer $creer): static
    {
        if (!$this->creers->contains($creer)) {
            $this->creers->add($creer);
            $creer->setQuiz($this);
        }

        return $this;
    }

    public function removeCreer(Creer $creer): static
    {
        if ($this->creers->removeElement($creer)) {
            // set the owning side to null (unless already changed)
            if ($creer->getQuiz() === $this) {
                $creer->setQuiz(null);
            }
        }

        return $this;
    }
}
