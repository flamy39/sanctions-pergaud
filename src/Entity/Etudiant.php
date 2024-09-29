<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

#[ORM\Entity(repositoryClass: "App\Repository\EtudiantRepository")]
class Etudiant {
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private $id;

    #[ORM\Column(type: "string")]
    private $nom;

    #[ORM\Column(type: "string")]
    private $prenom;

    #[ORM\ManyToOne(targetEntity: Promotion::class, inversedBy: "etudiants")]
    #[ORM\JoinColumn(nullable: false)]
    private $promotion;

    #[ORM\OneToMany(targetEntity: Sanction::class, mappedBy: "etudiant")]
    private $sanctions;

    public function __construct()
    {
        $this->sanctions = new ArrayCollection();
    }

    // Getters et Setters
    // ...

    public function getPromotion(): ?Promotion
    {
        return $this->promotion;
    }

    public function setPromotion(?Promotion $promotion): self
    {
        $this->promotion = $promotion;
        return $this;
    }

    /**
     * @return Collection|Sanction[]
     */
    public function getSanctions(): Collection
    {
        return $this->sanctions;
    }

    public function addSanction(Sanction $sanction): self
    {
        if (!$this->sanctions->contains($sanction)) {
            $this->sanctions[] = $sanction;
            $sanction->setEtudiant($this);
        }
        return $this;
    }

    public function removeSanction(Sanction $sanction): self
    {
        if ($this->sanctions->removeElement($sanction)) {
            // set the owning side to null (unless already changed)
            if ($sanction->getEtudiant() === $this) {
                $sanction->setEtudiant(null);
            }
        }
        return $this;
    }

    public function __toString()
    {
        return $this->nom . ' ' . $this->prenom;
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
       
}
