<?php

namespace App\Entity;

use App\Repository\ProfRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProfRepository::class)
 */
class Prof
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
     * @ORM\Column(type="string", length=255)
     */
    private $prenom;

    /**
     * @ORM\Column(type="date")
     */
    private $datedenaissance;

    /**
     * @ORM\OneToMany(targetEntity=Classe::class, mappedBy="prof", orphanRemoval=true)
     */
    private $Classe;

    /**
     * @ORM\ManyToOne(targetEntity=Matiere::class, inversedBy="Prof")
     * @ORM\JoinColumn(nullable=false)
     */
    private $matiere;

    public function __construct()
    {
        $this->Classe = new ArrayCollection();
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

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getDatedenaissance(): ?\DateTimeInterface
    {
        return $this->datedenaissance;
    }

    public function setDatedenaissance(\DateTimeInterface $datedenaissance): self
    {
        $this->datedenaissance = $datedenaissance;

        return $this;
    }

    /**
     * @return Collection|Classe[]
     */
    public function getClasse(): Collection
    {
        return $this->Classe;
    }

    public function addClasse(Classe $classe): self
    {
        if (!$this->Classe->contains($classe)) {
            $this->Classe[] = $classe;
            $classe->setProf($this);
        }

        return $this;
    }

    public function removeClasse(Classe $classe): self
    {
        if ($this->Classe->removeElement($classe)) {
            // set the owning side to null (unless already changed)
            if ($classe->getProf() === $this) {
                $classe->setProf(null);
            }
        }

        return $this;
    }

    public function getMatiere(): ?Matiere
    {
        return $this->matiere;
    }

    public function setMatiere(?Matiere $matiere): self
    {
        $this->matiere = $matiere;

        return $this;
    }
}
