<?php

namespace App\Entity;

use App\Repository\MatiereRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MatiereRepository::class)
 */
class Matiere
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\OneToMany(targetEntity=Note::class, mappedBy="Matiere", orphanRemoval=true)
     */
    private $notes;

    /**
     * @ORM\OneToMany(targetEntity=Prof::class, mappedBy="matiere", orphanRemoval=true)
     */
    private $Prof;

    public function __construct()
    {
        $this->notes = new ArrayCollection();
        $this->Prof = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * @return Collection|Note[]
     */
    public function getNotes(): Collection
    {
        return $this->notes;
    }

    public function addNote(Note $note): self
    {
        if (!$this->notes->contains($note)) {
            $this->notes[] = $note;
            $note->setMatiere($this);
        }

        return $this;
    }

    public function removeNote(Note $note): self
    {
        if ($this->notes->removeElement($note)) {
            // set the owning side to null (unless already changed)
            if ($note->getMatiere() === $this) {
                $note->setMatiere(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Prof[]
     */
    public function getProf(): Collection
    {
        return $this->Prof;
    }

    public function addProf(Prof $prof): self
    {
        if (!$this->Prof->contains($prof)) {
            $this->Prof[] = $prof;
            $prof->setMatiere($this);
        }

        return $this;
    }

    public function removeProf(Prof $prof): self
    {
        if ($this->Prof->removeElement($prof)) {
            // set the owning side to null (unless already changed)
            if ($prof->getMatiere() === $this) {
                $prof->setMatiere(null);
            }
        }

        return $this;
    }
}
